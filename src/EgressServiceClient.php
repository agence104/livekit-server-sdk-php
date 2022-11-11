<?php

namespace Agence104\LiveKit;

use Livekit\EgressInfo;
use Livekit\EgressClient;
use Livekit\StreamOutput;
use Livekit\EncodingOptions;
use Livekit\DirectFileOutput;
use Livekit\StopEgressRequest;
use Livekit\ListEgressRequest;
use Livekit\EncodedFileOutput;
use Livekit\ListEgressResponse;
use Livekit\TrackEgressRequest;
use Livekit\UpdateLayoutRequest;
use Livekit\UpdateStreamRequest;
use Livekit\EncodingOptionsPreset;
use Livekit\RoomCompositeEgressRequest;
use Livekit\TrackCompositeEgressRequest;

class EgressServiceClient extends BaseServiceClient {

  /**
   * The Twirp RPC adapter for client implementation.
   *
   * @var \Livekit\EgressClient
   */
  protected $rpc;

  /**
   * {@inheritdoc}
   */
  public function __construct(string $host, string $apiKey = NULL, string $apiSecret = NULL) {
    parent::__construct($host,$apiKey, $apiSecret);

    $this->rpc = new EgressClient($host);
  }

  /**
   * Get the stream output parameters.
   *
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The output stream.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The output options.
   *
   * @return array
   *   The output parameters as an array.
   */
  public function getOutputParams(
    EncodedFileOutput|StreamOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL
  ): array {
    $file = NULL;
    $stream = NULL;
    $preset = NULL;
    $advanced = NULL;

    if ($output instanceof EncodedFileOutput && !empty($output->getFilepath())) {
      $file = $output;
    }
    else {
      $stream = $output;
    }

    if ($options) {
      if ($options instanceof EncodingOptionsPreset) {
        $preset = $options;
      }
      else {
        $advanced = $options;
      }
    }

    return [
      $file,
      $stream,
      $preset,
      $advanced
    ];
  }

  /**
   * Starts a room composite egress which uses a web template.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $layout
   *   The egress layout.
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The file or stream output.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   * @param bool $audioOnly
   *   The flag which defines if we record only the audio or not.
   * @param bool $videoOnly
   *   The flag which defines if we record only the video or not.
   * @param string $customBaseUrl
   *   The custom template url.
   *
   * @return \Livekit\EgressInfo
   */
  public function startRoomCompositeEgress(
    string $roomName,
    string $layout,
    EncodedFileOutput|StreamOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL,
    bool $audioOnly = FALSE,
    bool $videoOnly = FALSE,
    string $customBaseUrl = ''
  ): EgressInfo {
    [$file, $stream, $preset, $advanced] = $this->getOutputParams($output, $options);

    // Set the request data.
    $data = [
      'room_name' => $roomName,
      'layout' => $layout,
      'audio_only' => $audioOnly,
      'video_only' => $videoOnly,
      'custom_base_url' => $customBaseUrl,
    ];
    ($file)
      ? $data['file'] = $file
      : $data['stream'] = $stream;
    ($preset)
      ? $data['preset'] = $preset
      : $data['advanced'] = $advanced;

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartRoomCompositeEgress(
      $this->authHeader($videoGrant),
      new RoomCompositeEgressRequest($data)
    );
  }

  /**
   * Starts a track composite egress with up to one audio track and one video
   * track. Track IDs can be found using webhooks or one of the server SDKs.
   *
   * @param string $roomName
   *   The name of the room.
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The file or stream output.
   * @param string $audioTrackId
   *   The audio track id.
   * @param string $videoTrackId
   *   The video track id.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   *
   * @return \Livekit\EgressInfo
   */
  public function startTrackCompositeEgress(
    string $roomName,
    EncodedFileOutput|StreamOutput $output,
    string $audioTrackId = '',
    string $videoTrackId = '',
    EncodingOptionsPreset|EncodingOptions $options = NULL,
  ): EgressInfo {
    [$file, $stream, $preset, $advanced] = $this->getOutputParams($output, $options);

    // Set the request data.
    $data = [
      'room_name' => $roomName,
      'audio_track_id' => $audioTrackId,
      'video_track_id' => $videoTrackId,
    ];
    ($file)
      ? $data['file'] = $file
      : $data['stream'] = $stream;
    ($preset)
      ? $data['preset'] = $preset
      : $data['advanced'] = $advanced;

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartTrackCompositeEgress(
      $this->authHeader($videoGrant),
      new TrackCompositeEgressRequest($data)
    );
  }

  /**
   * Starts a track egress. Track ID can be found using webhooks or one of the
   * server SDKs.
   *
   * @param string $roomName
   *   The name of the room.
   * @param \Livekit\DirectFileOutput|string $output
   *   The file or websocket output.
   * @param string $trackId
   *   The track id
   *
   * @return \Livekit\EgressInfo
   */
  public function startTrackEgress(
    string $roomName,
    DirectFileOutput|string $output,
    string $trackId
  ): EgressInfo {
    // Set the request data.
    $data = [
      'room_name' => $roomName,
      'track_id' => $trackId,
    ];
    ($output instanceof DirectFileOutput && !empty($output->getFilepath()))
      ? $data['file'] = $output
      : $data['websocket_url'] = $output;

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartTrackEgress(
      $this->authHeader($videoGrant),
      new TrackEgressRequest($data)
    );
  }

  /**
   * Updates the web layout of an active RoomCompositeEgress.
   *
   * @param string $egressId
   *   The egress id.
   * @param string $layout
   *   The egress layout.
   *
   * @return \Livekit\EgressInfo
   */
  public function updateLayout(
    string $egressId,
    string $layout
  ): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->UpdateLayout(
      $this->authHeader($videoGrant),
      new UpdateLayoutRequest([
        'egress_id' => $egressId,
        'laytout' => $layout,
      ])
    );
  }

  /**
   * Adds or removes stream urls from an active stream.
   *
   * @param string $egressId
   *   The egress id.
   * @param array $addOutputUrls
   *   The output Urls to add to the active stream.
   * @param array $removeOutputUrls
   *   The output Urls to remove from the active stream.
   *
   * @return \Livekit\EgressInfo
   */
  public function updateStream(
    string $egressId,
    array $addOutputUrls = [],
    array $removeOutputUrls = []
  ): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->UpdateStream(
      $this->authHeader($videoGrant),
      new UpdateStreamRequest([
        'egress_id' => $egressId,
        'add_output_urls' => $addOutputUrls,
        'remove_output_urls' => $removeOutputUrls,
      ])
    );
  }

  /**
   * Gets the list of active egress. Does not include completed egress.
   *
   * @param string $roomName
   *   The name of the room.
   *
   * @return \Livekit\ListEgressResponse
   */
  public function listEgress(string $roomName = ''): ListEgressResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->ListEgress(
      $this->authHeader($videoGrant),
      new ListEgressRequest([
        'room_name' => $roomName,
      ])
    );
  }

  /**
   * Stops an active egress.
   *
   * @param string $egressId
   *   The egress id.
   *
   * @return \Livekit\EgressInfo
   */
  public function stopEgress(string $egressId): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StopEgress(
      $this->authHeader($videoGrant),
      new StopEgressRequest([
        'egress_id' => $egressId,
      ])
    );
  }

}
