<?php

namespace Agence104\LiveKit;

use Livekit\IngressInfo;
use Livekit\IngressInput;
use Livekit\IngressClient;
use Livekit\ListIngressRequest;
use Livekit\IngressAudioOptions;
use Livekit\IngressVideoOptions;
use Livekit\ListIngressResponse;
use Livekit\UpdateIngressRequest;
use Livekit\CreateIngressRequest;
use Livekit\DeleteIngressRequest;

class IngressServiceClient extends BaseServiceClient {

  /**
   * The Twirp RPC adapter for client implementation.
   *
   * @var \Livekit\IngressClient
   */
  protected $rpc;

  /**
   * {@inheritdoc}
   */
  public function __construct(string $host, string $apiKey = NULL, string $apiSecret = NULL) {
    parent::__construct($host,$apiKey, $apiSecret);

    $this->rpc = new IngressClient($host);
  }

  /**
   * Create an ingress instance.
   *
   * @param int $inputType
   *   The ingress input type. Currently, \Livekit\IngressInput::RTMP_INPUT is
   *   the only supported type.
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
   *
   * @return \Livekit\IngressInfo
   */
  public function createIngress(
    int $inputType,
    string $name = '',
    string $roomName = '',
    string $participantIdentity = '',
    string $participantName = '',
    IngressAudioOptions $audio = NULL,
    IngressVideoOptions $video = NULL
  ): IngressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->CreateIngress(
      $this->authHeader($videoGrant),
      new CreateIngressRequest([
        'input_type' => $inputType,
        'name' => $name,
        'room_name' => $roomName,
        'participant_identity' => $participantIdentity,
        'participant_name' => $participantName,
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
   *
   * @return \Livekit\IngressInfo
   */
  public function updateIngress(
    string $ingressId,
    string $name = '',
    string $roomName = '',
    string $participantIdentity = '',
    string $participantName = '',
    IngressAudioOptions $audio = NULL,
    IngressVideoOptions $video = NULL
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
        'audio' => $audio,
        'video' => $video,
      ])
    );
  }

  /**
   * Gets the list of active ingress.
   *
   * @param string $roomName
   *   Optional, The room name.
   *
   * @return \Livekit\ListIngressResponse
   */
  public function listIngress(string $roomName = ''): ListIngressResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setIngressAdmin();
    return $this->rpc->ListIngress(
      $this->authHeader($videoGrant),
      new ListIngressRequest([
        'room_name' => $roomName,
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
