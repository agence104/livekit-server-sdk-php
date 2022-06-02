<?php

namespace Agence104\LiveKit;

use Firebase\JWT\JWT;

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
   * @param \Agence104\LiveKit\AccessTokenOptions $options
   *   List of options.
   * @param string|null $apiKey
   *   The LiveKit API Key, can be set in env LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The LiveKit API Secret Key, can be set in env LIVEKIT_API_SECRET.
   *
   * @throws \Exception
   */
  public function __construct(AccessTokenOptions $options, string $apiKey = NULL, string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
    $this->grants = new ClaimGrants();
    $this->identity = $options->getIdentity();
    $this->ttl = $options->getTtl();

    if ($metadata = $options->getMetadata()) {
      $this->grants->setMetadata($metadata);
    }

    if ($name = $options->getName()) {
      $this->grants->setName($name);
    }
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
  function getToken(): string {
    $payload = [];

    if ($this->identity) {
      $payload += [
        "sub" => $this->identity,
        "jti" => $this->identity,
      ];
    }
    elseif ($this->grants->getVideoGrant()->isRoomJoin()) {
      throw new \Exception('Identity is required for join but not set');
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

}
