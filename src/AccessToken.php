<?php

namespace Agence104\LiveKit;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Generates an AccessToken for the LiveKit server.
 */
class AccessToken {

  /**
   * The API Key.
   */
  protected string $apiKey;

  /**
   * The API Secret.
   */
  protected string $apiSecret;

  /**
   * The Access Token Grants.
   */
  protected ClaimGrants $grants;

  /**
   * The Access Token Identity.
   */
  protected ?string $identity = NULL;

  /**
   * The Time to live of the token. Defaults to 6 hours.
   */
  protected int $ttl = 4 * 60 * 60;

  /**
   * AccessToken Constructor.
   *
   * @param string|null $apiKey
   *   The LiveKit API Key, can be set in env LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The LiveKit API Secret Key, can be set in env LIVEKIT_API_SECRET.
   * @param \Agence104\LiveKit\AccessTokenOptions|null $options
   *   The AccessTokenOptions object.
   *
   * @throws \Exception
   */
  public function __construct(?string $apiKey = NULL, ?string $apiSecret = NULL, ?AccessTokenOptions $options = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
    $this->grants = new ClaimGrants();

    if ($options) {
      $this->init($options);
    }
  }

  /**
   * Initialize the AccessToken.
   *
   * @param \Agence104\LiveKit\AccessTokenOptions $options
   *   List of options.
   *
   * @return $this
   */
  public function init(AccessTokenOptions $options): self {
    if ($identity = $options->getIdentity()) {
      $this->identity = $identity;
    }

    if ($ttl = $options->getTtl()) {
      $this->ttl = $ttl;
    }

    if ($metadata = $options->getMetadata()) {
      $this->grants->setMetadata($metadata);
    }

    if ($attributes = $options->getAttributes()) {
      $this->grants->setAttributes($attributes);
    }

    if ($name = $options->getName()) {
      $this->grants->setName($name);
    }

    return $this;
  }

  /**
   * Set the video grant to the token.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *   The video grant.
   *
   * @return $this
   */
  public function setGrant(VideoGrant $videoGrant): self {
    $this->grants->setVideoGrant($videoGrant);
    return $this;
  }

  /**
   * Get the video grant.
   *
   * @return \Agence104\LiveKit\VideoGrant
   *   The video grant.
   */
  public function getGrant(): VideoGrant {
    return $this->grants->getVideoGrant();
  }

  /**
   * Set a SIP grant to the token.
   *
   * @param \Agence104\LiveKit\SIPGrant $sipGrant
   *   The SIP grant.
   *
   * @return $this
   */
  public function setSipGrant(SIPGrant $sipGrant): self {
    $this->grants->setSipGrant($sipGrant);
    return $this;
  }

  /**
   * Get the SIP grant.
   *
   * @return \Agence104\LiveKit\SIPGrant
   *   The SIP grant.
   */
  public function getSipGrant(): SIPGrant {
    return $this->grants->getSipGrant();
  }

  /**
   * Set participant metadata, only used when joining a room.
   *
   * @param string $metadata
   *   The metadata value.
   *
   * @return $this
   */
  public function setMetadata(string $metadata): self {
    $this->grants->setMetaData($metadata);
    return $this;
  }

  /**
   * Set attributes to be passed to the Participant.
   *
   * @param array $attributes
   *   The attributes array.
   *
   * @return $this
   */
  public function setAttributes(array $attributes): self {
    $this->grants->setAttributes($attributes);
    return $this;
  }

  /**
   * Get the SHA256 hash to the token.
   *
   * @return string
   *   The SHA256 hash of the token.
   */
  public function getSha256(): string {
    return $this->grants->getSha256();
  }

  /**
   * Set the SHA256 hash to the token.
   *
   * @param string $sha256
   *   The SHA256 hash of the token.
   *
   * @return $this
   */
  public function setSha256(string $sha256): self {
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
  public function toJwt(): string {
    $payload = [];

    if ($this->identity) {
      $payload += [
        "sub" => $this->identity,
        "jti" => $this->identity,
      ];
    }
    elseif ($this->grants->getVideoGrant()->isRoomJoin()) {
      throw new \Exception('Identity is required to join but has not been set.');
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
  public function fromJwt(string $token): ClaimGrants {
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

    if (isset($decoded_token->sip)) {
      $decoded_token->sipGrant = (array) $decoded_token->sip;
      unset($decoded_token->sip);
    }

    if (isset($decoded_token->attributes)) {
      $decoded_token->attributes = (array) $decoded_token->attributes;
    }

    return new ClaimGrants((array) $decoded_token);
  }

}
