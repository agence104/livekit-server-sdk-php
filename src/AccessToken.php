<?php

namespace Agence104\LiveKit;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AccessToken {

  /**
   * The API Key.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * The API Secret.
   *
   * @var string
   */
  protected $apiSecret;

  /**
   * The Access Token Grants.
   *
   * @var \Agence104\LiveKit\ClaimGrants
   */
  protected $grants;

  /**
   * The Access Token Identity.
   *
   * @var string
   */
  protected $identity;

  /**
   * The Time to live of the token. Defaults to 6 hours.
   *
   * @var numeric|string
   */
  protected $ttl;

  /**
   * AccessToken Constructor.
   *
   * @param string|null $apiKey
   *   The LiveKit API Key, can be set in env LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The LiveKit API Secret Key, can be set in env LIVEKIT_API_SECRET.
   *
   * @throws \Exception
   */
  public function __construct(?string $apiKey = NULL, ?string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
  }

  /**
   * Initialize the AccessToken.
   *
   * @param \Agence104\LiveKit\AccessTokenOptions $options
   *   List of options.
   *
   * @return $this
   */
  public function init(AccessTokenOptions $options): self{
    $this->grants = new ClaimGrants([
      'identity' => $options->getIdentity(),
    ]);
    $this->identity = $options->getIdentity();
    $this->ttl = $options->getTtl();

    if ($metadata = $options->getMetadata()) {
      $this->grants->setMetadata($metadata);
    }

    if ($name = $options->getName()) {
      $this->grants->setName($name);
    }

    return $this;
  }

  /**
   * Set a video grant to the token.
   *
   * @param \Agence104\LiveKit\VideoGrant
   *
   * @return $this
   */
  function setGrant(VideoGrant $videoGrant): self {
    $this->grants->setVideoGrant($videoGrant);
    return $this;
  }

  /**
   * Set metadata to be passed to the Participant, used only when joining the room
   *
   * @param string $metadata
   *   The metadata value.
   *
   * @return $this
   */
  function setMetadata(string $metadata): self {
    $this->grants->setMetaData($metadata);
    return $this;
  }

  /**
   * @return string
   */
  function getSha256(): string {
    return $this->grants->getSha256();
  }

  /**
   * @param string $sha256
   *
   * @return $this
   */
  function setSha256(string $sha256): self {
    $this->grants->setSha256($sha256);
    return $this;
  }

  /**
   * Get the JWT token string.
   *
   * @return string
   *   A signed JWT
   *
   * @throws \Exception
   */
  function toJwt(): string {
    $payload = [];

    if ($this->identity) {
      $payload += [
        "sub" => $this->identity,
        "jti" => $this->identity,
      ];
    }
    elseif ($this->grants->getVideoGrant()->isRoomJoin()) {
      throw new \Exception('Identity is required to join but has not set.');
    }

    $jwt_timestamp = time();
    $payload += [
      "exp" => $jwt_timestamp + $this->ttl,
      "nbf" => $jwt_timestamp,
      "iat" => $jwt_timestamp,
      "iss" => $this->apiKey,
    ];
    $payload += $this->grants->getData();

    return JWT::encode($payload, $this->apiSecret, 'HS256');
  }

  /**
   * Validate the JWT token and return the grants assign from the token.
   *
   * @param string $token
   *   The JWT Token.
   *
   * @return ClaimGrants
   *   The ClaimGrants Object.
   *
   * @throws \Exception
   */
  function fromJwt(string $token): ClaimGrants {
    $decoded_token = JWT::decode($token, new Key($this->apiSecret, 'HS256'));

    if (!$decoded_token) {
      throw new \Exception('Invalid token.');
    }

    if ($decoded_token->iss != $this->apiKey) {
      throw new \Exception('Invalid issuer.');
    }

    if (isset($decoded_token->video)) {
      $decoded_token->videoGrant = (array) $decoded_token->video;
      unset($decoded_token->video);
    }

    // Set the identity for the ClaimGrants.
    if (isset($decoded_token->sub)) {
      $decoded_token->identity = $decoded_token->sub;
    }

    return new ClaimGrants((array) $decoded_token);
  }

}
