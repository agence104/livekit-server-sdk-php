<?php

namespace Agence104\LiveKit;

use Livekit\WebhookEvent;

/**
 * Defines the webhook receiver.
 */
class WebhookReceiver {

  /**
   * The AccessToken object.
   */
  protected AccessToken $accessToken;

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
  public function __construct(?string $apiKey = NULL, ?string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->accessToken = new AccessToken($apiKey, $apiSecret);
  }

  /**
   * Process a webhook request.
   *
   * @param string $body
   *   The string of the posted body.
   * @param string|null $authHeader
   *   The `Authorization` header of the request.
   * @param bool $skipAuth
   *   The flag which defines if we should skip auth validation.
   *   True to skip auth validation, false otherwise.
   * @param bool $ignoreUnknownFields
   *   The flag which defines if unknown fields should be ignored when parsing
   *   the webhook data. True to ignore unknown fields, false otherwise.
   *
   * @return \Livekit\WebhookEvent
   *   The webhook event.
   *
   * @throws \Exception
   */
  public function receive(string $body, ?string $authHeader = NULL, bool $skipAuth = FALSE, bool $ignoreUnknownFields = TRUE): WebhookEvent {
    // Verify token.
    if (!$skipAuth) {
      if (!$authHeader) {
        throw new \Exception('Authorization header is empty');
      }

      $grants = $this->accessToken->fromJwt($authHeader);

      // Validate Sha256.
      $hash = hash('sha256', $body, TRUE);
      if ($grants->getSha256() !== base64_encode($hash)) {
        throw new \Exception('Sha256 checksum of the body does not match.');
      }
    }

    $event = new WebhookEvent();
    $event->mergeFromJsonString($body, $ignoreUnknownFields);
    return $event;
  }

}
