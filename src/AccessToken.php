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
   * The Access Token Grants
   *
   * @var \Agence104\LiveKit\ClaimGrants
   */
  protected $grants;

  /**
   * The Access Token Identity
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

  public function __construct($apiKey, $apiSecret, AccessTokenOptions $options) {
    if (!$apiKey || !$apiSecret) {
      throw new \Exception('Api-key and api-secret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
    $this->grants = new ClaimGrants();
    $this->identity = $options->getIdentity();
    $this->ttl = $options->getTtl();

    if ($options->getMetadata()) {
      $this->grants->setMetadata($options->getMetadata());
    }

    if ($options->getName()) {
      $this->grants->setName($options->getName());
    }
  }

  /**
   * Adds a video grant to this token.
   * @param \Agence104\LiveKit\VideoGrant
   */
  function addGrant(VideoGrant $videoGrant) {
    $this->grants->setVideoGrant($videoGrant);
  }

  /**
   * Set metadata to be passed to the Participant, used only when joining the room
   */
  function setMetadata($metadata) {
    $this->grants->setMetaData($metadata);
  }

  function getSha256(): string {
    return $this->grants->getSha256();
  }

  function setSha256($sha) {
    $this->grants->setSha256($sha);
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
      "video" => $this->grants->getVideoGrant()->getData(),
      "name" => $this->grants->getName(),
    ];

    if ($metadata = $this->grants->getMetadata()) {
      $payload['metadata'] = $metadata;
    }

    return JWT::encode($payload, $this->apiSecret, 'HS256');
  }

}
