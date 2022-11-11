<?php

namespace Agence104\LiveKit;

use Twirp\Context;

abstract class BaseServiceClient {

  /**
   * The API Key, can be set in env var LIVEKIT_API_KEY.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * The API Secret, can be set in env var LIVEKIT_API_SECRET.
   *
   * @var string
   */
  protected $apiSecret;

  /**
   * BaseServiceClient Class Constructor.
   *
   * @param string $host
   *   The hostname including protocol. i.e. 'https://cluster.livekit.io'.
   * @param string|null $apiKey
   *   The API Key, can be set in env var LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The API Secret, can be set in env var LIVEKIT_API_SECRET.
   *
   * @throws \Exception
   */
  public function __construct(string $host, string $apiKey = NULL, string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
  }

  /**
   * Fetches the authorization header to be passed in the request.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *   The grants to apply on the AccessToken.
   *
   * @return array
   *   If everything worked, then the header values are returned,
   *   else an empty array is returned.
   */
  protected function authHeader(VideoGrant $videoGrant): array {
    $tokenOptions = (new AccessTokenOptions())
      ->setTtl(10 * 60); // 10 minutes.

    try {
      $accessToken = (new AccessToken($this->apiKey, $this->apiSecret))
        ->init($tokenOptions)
        ->setGrant($videoGrant);
      return Context::withHttpRequestHeaders([], [
        "Authorization" => "Bearer " . $accessToken->toJwt(),
      ]);
    }
    catch (\Exception $e) {
      return [];
    }
  }

}
