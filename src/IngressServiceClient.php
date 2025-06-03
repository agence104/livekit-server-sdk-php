<?php

namespace Agence104\LiveKit;

use Livekit\CreateIngressRequest;
use Livekit\DeleteIngressRequest;
use Livekit\IngressAudioOptions;
use Livekit\IngressClient;
use Livekit\IngressInfo;
use Livekit\IngressVideoOptions;
use Livekit\ListIngressRequest;
use Livekit\ListIngressResponse;
use Livekit\UpdateIngressRequest;

/**
 * Define the Ingress service client.
 */
class IngressServiceClient extends BaseServiceClient {

  /**
   * The Twirp RPC adapter for client implementation.
   */
  protected IngressClient $rpc;

  /**
   * {@inheritdoc}
   */
  public function __construct(?string $host = NULL, ?string $apiKey = NULL, ?string $apiSecret = NULL) {
    parent::__construct($host, $apiKey, $apiSecret);
    $this->rpc = new IngressClient($this->host);
  }

  /**
   * Create an ingress instance.
   *
   * @param int $inputType
   *   The ingress input type. @see \Livekit\IngressInput class for options.
   * @param string $name
   *   Optional, name to identify the ingress.
   * @param string $roomName
   *   Optional, you can attach to a room at a later time.
   * @param string $participantIdentity
   *   Optional, identity of the participant to publish as.
   * @param string $participantName
   *   Optional, display name of the participant. (used for display only)
   * @param \LiveKit\IngressAudioOptions|null $audio
   *   Optional, custom audio encoding parameters.
   * @param \LiveKit\IngressVideoOptions|null $video
   *   Optional, custom video encoding parameters.
   * @param bool|null $bypassTranscoding
   *   Optional, whether to pass through the incoming media without transcoding,
   *   only compatible with some input types.
   * @param string $url
   *   Optional, the url to pull the media from, when using inputType URL_INPUT.
   *
   * @return \Livekit\IngressInfo
   *   The created ingress instance.
   */
  public function createIngress(
    int $inputType,
    string $name = '',
    string $roomName = '',
    string $participantIdentity = '',
    string $participantName = '',
    ?IngressAudioOptions $audio = NULL,
    ?IngressVideoOptions $video = NULL,
    ?bool $bypassTranscoding = NULL,
    ?string $url = NULL
  ): IngressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->CreateIngress(
      $this->authHeader($videoGrant),
      new CreateIngressRequest([
        'input_type' => $inputType,
        'url' => $url,
        'name' => $name,
        'room_name' => $roomName,
        'participant_identity' => $participantIdentity,
        'participant_name' => $participantName,
        'bypass_transcoding' => $bypassTranscoding,
        'audio' => $audio,
        'video' => $video,
      ])
    );
  }

  /**
   * Update an ingress instance.
   *
   * @param string $ingressId
   *   The ingress id.
   * @param string $name
   *   Optional, name to identify the ingress.
   * @param string $roomName
   *   Optional, you can attach to a room at a later time.
   * @param string $participantIdentity
   *   Optional, identity of the participant to publish as.
   * @param string $participantName
   *   Optional, display name of the participant.
   * @param \LiveKit\IngressAudioOptions|null $audio
   *   Optional, custom audio encoding parameters.
   * @param \LiveKit\IngressVideoOptions|null $video
   *   Optional, custom video encoding parameters.
   * @param bool|null $bypassTranscoding
   *   Optional, whether to forward input media unprocessed, for WHIP only.
   *
   * @return \Livekit\IngressInfo
   *   The updated ingress instance.
   */
  public function updateIngress(
    string $ingressId,
    string $name = '',
    string $roomName = '',
    string $participantIdentity = '',
    string $participantName = '',
    ?IngressAudioOptions $audio = NULL,
    ?IngressVideoOptions $video = NULL,
    ?bool $bypassTranscoding = NULL,
  ): IngressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->UpdateIngress(
      $this->authHeader($videoGrant),
      new UpdateIngressRequest([
        'ingress_id' => $ingressId,
        'name' => $name,
        'room_name' => $roomName,
        'participant_identity' => $participantIdentity,
        'participant_name' => $participantName,
        'bypass_transcoding' => $bypassTranscoding,
        'audio' => $audio,
        'video' => $video,
      ])
    );
  }

  /**
   * Gets the list of active ingress.
   *
   * @param string $roomName
   *   Optional, the room name, otherwise lists all ingress endpoints.
   * @param string $ingressId
   *   Optional, filter by an ingress ID.
   *
   * @return \Livekit\ListIngressResponse
   *   The list of ingress instances.
   */
  public function listIngress(
    string $roomName = '',
    string $ingressId = ''
  ): ListIngressResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->ListIngress(
      $this->authHeader($videoGrant),
      new ListIngressRequest([
        'room_name' => $roomName,
        'ingress_id' => $ingressId,
      ])
    );
  }

  /**
   * Gets the list of active ingress.
   *
   * @param string $ingressId
   *   The ingress id.
   *
   * @return \Livekit\IngressInfo
   *   The deleted ingress instance.
   */
  public function deleteIngress(string $ingressId): IngressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->DeleteIngress(
      $this->authHeader($videoGrant),
      new DeleteIngressRequest([
        'ingress_id' => $ingressId,
      ])
    );
  }

}
