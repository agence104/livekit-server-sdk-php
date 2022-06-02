<?php

namespace Agence104\LiveKit;

use Livekit\WebhookEvent;
use mysql_xdevapi\Exception;

class WebhookReceiver {

  /**
   * The token verifier.
   *
   * @var \Agence104\LiveKit\TokenVerifier
   */
  protected $verifier;

  /**
   * WebhookReceiver Constructor.
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

    $this->verifier = new TokenVerifier($apiKey, $apiSecret);
  }

  /**
   * Process a webhook request.
   *
   * @param string $body
   *   The string of the posted body.
   * @param string|NULL $authHeader
   *   The `Authorization` header of the request.
   * @param bool $skipAuth
   *   The flag which defines if we should skip auth validation.
   *   True to skip auth validation, false otherwise.
   *
   * @return \Livekit\WebhookEvent
   * @throws \Exception
   */
  function receive(string $body, string $authHeader = NULL, bool $skipAuth = FALSE): WebhookEvent {

    // Verify token.
    if (!$skipAuth) {
      if (!$authHeader) {
        throw new Exception('Authorization header is empty');
      }

      $grants = $this->verifier->verify($authHeader);

      // Confirm sha.
      $hash = hash('sha256', $body);
      if ($grants->setSha256() !== base64_encode($hash)) {
        throw new \Exception('Sha256 checksum of the body does not match.');
      }
    }

    return new WebhookEvent(
      json_decode($body, TRUE)
    );
  }

}
