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
  public $apiKey;

  /**
   * The API Secret.
   *
   * @var string
   */
  public $apiSecret;

  /**
   * The Access Token Grants
   *
   * @var \Agence104\LiveKit\ClaimGrants
   */
  public $grants;

  /**
   * The Access Token Identity
   *
   * @var string
   */
  public $identity;

  /**
   * The Time to live of the token. Defaults to 6 hours.
   *
   * @var numeric|string
   */
  public $ttl = 4 * 60 * 60;

  public function __construct($apiKey, $apiSecret, AccessTokenOpts $options) {
    if (!$apiKey || !$apiSecret) {
      throw new \Exception('Api-key and api-secret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
    $this->grants = new ClaimGrants();
    $this->identity = $options->getIdentity();
    $this->ttl = $options->getTtl() ?? 4 * 60 * 60;


    if ($options->getMetadata()) {
      $this->setMetadata($options->getMetadata());
    }

    if ($options->getName()) {
      $this->setName($options->getName());
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

  function setName($name) {
    $this->grants->setName($name);
  }

  function getSha256() {
    return $this->grants->getSha256();
  }

  function setSha256($sha) {
    $this->grants->setSha256($sha);
  }

  /**
   * Get the JWT token string.
   *
   * @return \Firebase\JWT\JWT
   *   The Encoded Token.
   *
   * @throws \Exception
   */
  function getToken() {
    if (!$this->identity) {
      throw new \Exception('Identity is required for join but not set');
    }

    $jwt_timestamp = time();
    $payload = [
      "exp" => $jwt_timestamp + $this->ttl,
      "nbf" => $jwt_timestamp - 5,
      "iss" => $this->apiKey,
      "sub" => $this->identity,
      "jti" => $this->identity,
    ];

    return JWT::encode($payload, $this->apiSecret, 'HS256');
  }

}
