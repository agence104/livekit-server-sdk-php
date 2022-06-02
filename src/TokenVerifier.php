<?php

namespace Agence104\LiveKit;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenVerifier {

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
   * TokenVerifier Constructor.
   *
   * @param string|null $apiKey
   *   The LiveKit API Key, can be set in env LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The LiveKit API Secret Key, can be set in env LIVEKIT_API_SECRET.
   *
   * @throws \Exception
   */
  public function __construct(string $apiKey = NULL, string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
  }

  /**
   * Verify & validate the JWT token.
   *
   * @param string $token
   *   The AccessToken Value.
   *
   * @return ClaimGrants
   *   The ClaimGrants Object.
   *
   * @throws \Exception
   */
  function verify(string $token): ClaimGrants {
    $decoded_token = JWT::decode($token, new Key($this->apiSecret, 'HS256'));

    if (!$decoded_token) {
      throw new \Exception('Invalid token!');
    }

    if ($decoded_token->iss != $this->apiKey) {
      throw new \Exception('Invalid issuer!');
    }

    if (isset($decoded_token->video)) {
      $decoded_token->videoGrant = (array) $decoded_token->video;
      unset($decoded_token->video);
    }

    return new ClaimGrants((array) $decoded_token);
  }

}
