<?php

namespace Agence104\LiveKit;

use Livekit\EgressInfo;
use Livekit\EgressClient;
use Livekit\ImageOutput;
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
use Livekit\SegmentedFileOutput;
use Livekit\EncodingOptionsPreset;
use Livekit\RoomCompositeEgressRequest;
use Livekit\TrackCompositeEgressRequest;
use Livekit\WebEgressRequest;

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
  public function __construct(?string $host = NULL, ?string $apiKey = NULL, ?string $apiSecret = NULL) {
    parent::__construct($host,$apiKey, $apiSecret);

    $this->rpc = new EgressClient($this->host);
  }

  /**
   * Get the stream output parameters.
   *
   * @param \Agence104\LiveKit\EncodedOutputs|\Livekit\EncodedFileOutput|\Livekit\StreamOutput|\Livekit\SegmentedFileOutput|\Livekit\ImageOutput $output
   *   The output stream.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The output options.
   *
   * @return array
   *   The output parameters as an array.
   */
  public function getOutputParams(
    EncodedOutputs|EncodedFileOutput|StreamOutput|SegmentedFileOutput|ImageOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL
  ): array {
    $file = NULL;
    $fileOutputs = NULL;
    $stream = NULL;
    $streamOutputs = NULL;
    $preset = NULL;
    $advanced = NULL;
    $segments = NULL;
    $segmentOutputs = NULL;
    $imageOutputs = NULL;

    if ($output instanceof EncodedOutputs) {
      $fileOutputs = $output->getFile() ? [$output->getFile()] : NULL;
      $streamOutputs = $output->getStream() ? [$output->getStream()] : NULL;
      $segmentOutputs = $output->getSegments() ? [$output->getSegments()] : NULL;
      $imageOutputs = $output->getSegments()  ? [$output->getImage()] : NULL;
    }
    elseif ($output instanceof EncodedFileOutput && !empty($output->getFilepath())) {
      $file = $output;
      $fileOutputs = [$file];
    }
    elseif ($output instanceof SegmentedFileOutput && !empty($output->getFilenamePrefix())) {
      $segments = $output;
      $segmentOutputs = [$segments];
    }
    elseif ($output instanceof StreamOutput && !empty($output->getUrls())) {
      $streamOutputs = [$output];
    }
    elseif ($output instanceof ImageOutput) {
      $imageOutputs = [$output];
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
      $segments,
      $preset,
      $advanced,
      $fileOutputs,
      $streamOutputs,
      $segmentOutputs,
      $imageOutputs,
    ];
  }

  /**
   * Starts a room composite egress which uses a web template.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $layout
   *   The egress layout.
   * @param \Agence104\LiveKit\EncodedOutputs|\Livekit\EncodedFileOutput|\Livekit\StreamOutput|\Livekit\SegmentedFileOutput|\Livekit\ImageOutput $output
   *   The egress output.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   * @param bool $audioOnly
   *   The flag which defines if we record only the audio or not.
   * @param bool $videoOnly
   *   The flag which defines if we record only the video or not.
   * @param string $customBaseUrl
   *   The custom template url. (default https://recorder.livekit.io)
   *
   * @return \Livekit\EgressInfo
   */
  public function startRoomCompositeEgress(
    string $roomName,
    string $layout,
    EncodedOutputs|EncodedFileOutput|StreamOutput|SegmentedFileOutput|ImageOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL,
    bool $audioOnly = FALSE,
    bool $videoOnly = FALSE,
    string $customBaseUrl = ''
  ): EgressInfo {
    [
      $file,
      $stream,
      $segments,
      $preset,
      $advanced,
      $fileOutputs,
      $streamOutputs,
      $segmentOutputs,
      $imageOutputs,
    ] = $this->getOutputParams($output, $options);

    // Set the request data.
    $data = [
      'room_name' => $roomName,
      'layout' => $layout,
      'audio_only' => $audioOnly,
      'video_only' => $videoOnly,
      'custom_base_url' => $customBaseUrl,
    ];

    $data += array_filter([
      'file_outputs' => $fileOutputs,
      'stream_outputs' => $streamOutputs,
      'segment_outputs' => $segmentOutputs,
      'image_outputs' => $imageOutputs,
    ]);

    if ($file) {
      $data['file'] = $file;
    } elseif ($segments) {
      $data['segments'] = $segments;
    } elseif ($stream) {
      $data['stream'] = $stream;
    }

    if ($preset) {
      $data['preset'] = $preset;
    }
    else {
      $data['advanced'] = $advanced;
    }

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartRoomCompositeEgress(
      $this->authHeader($videoGrant),
      new RoomCompositeEgressRequest($data)
    );
  }

  /**
   * Starts a Web egress.
   *
   * @param string $url
   *   The URL of the web page to record
   * @param \Agence104\LiveKit\EncodedOutputs|\Livekit\EncodedFileOutput|\Livekit\StreamOutput|\Livekit\SegmentedFileOutput|\Livekit\ImageOutput $output
   *   The egress output.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   * @param bool $audioOnly
   *   The flag which defines if we record only the audio or not.
   * @param bool $videoOnly
   *   The flag which defines if we record only the video or not.
   * @param bool $awaitStartSignal
   *   The flag which defines if we wait for the start signal or not.
   *
   * @return \Livekit\EgressInfo
   */
  public function startWebEgress(
    string $url,
    EncodedOutputs|EncodedFileOutput|StreamOutput|SegmentedFileOutput|ImageOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL,
    bool $audioOnly = FALSE,
    bool $videoOnly = FALSE,
    bool $awaitStartSignal = FALSE
  ): EgressInfo {
    [
      $file,
      $stream,
      $segments,
      $preset,
      $advanced,
      $fileOutputs,
      $streamOutputs,
      $segmentOutputs,
      $imageOutputs,
    ] = $this->getOutputParams($output, $options);

    // Set the request data.
    $data = [
      'url' => $url,
      'audio_only' => $audioOnly,
      'video_only' => $videoOnly,
      'await_start_signal' => $awaitStartSignal,
    ];

    $data += array_filter([
      'file_outputs' => $fileOutputs,
      'stream_outputs' => $streamOutputs,
      'segment_outputs' => $segmentOutputs,
      'image_outputs' => $imageOutputs,
    ]);

    if ($file) {
      $data['file'] = $file;
    } elseif ($segments) {
      $data['segments'] = $segments;
    } elseif ($stream) {
      $data['stream'] = $stream;
    }

    if ($preset) {
      $data['preset'] = $preset;
    }
    else {
      $data['advanced'] = $advanced;
    }

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartWebEgress(
      $this->authHeader($videoGrant),
      new WebEgressRequest($data)
    );
  }

  /**
   * Starts a track composite egress with up to one audio track and one video
   * track. Track IDs can be found using webhooks or one of the server SDKs.
   *
   * @param string $roomName
   *   The name of the room.
   * @param \Agence104\LiveKit\EncodedOutputs|\Livekit\EncodedFileOutput|\Livekit\StreamOutput|\Livekit\SegmentedFileOutput|\Livekit\ImageOutput $output
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
    EncodedOutputs|EncodedFileOutput|StreamOutput|SegmentedFileOutput|ImageOutput $output,
    string $audioTrackId = '',
    string $videoTrackId = '',
    EncodingOptionsPreset|EncodingOptions $options = NULL,
  ): EgressInfo {
    [
      $file,
      $stream,
      $segments,
      $preset,
      $advanced,
      $fileOutputs,
      $streamOutputs,
      $segmentOutputs,
      $imageOutputs,
    ] = $this->getOutputParams($output, $options);

    // Set the request data.
    $data = [
      'room_name' => $roomName,
      'audio_track_id' => $audioTrackId,
      'video_track_id' => $videoTrackId,
    ];

    $data += array_filter([
      'file_outputs' => $fileOutputs,
      'stream_outputs' => $streamOutputs,
      'segment_outputs' => $segmentOutputs,
      'image_outputs' => $imageOutputs,
    ]);

    if ($file) {
      $data['file'] = $file;
    } elseif ($segments) {
      $data['segments'] = $segments;
    } elseif ($stream) {
      $data['stream'] = $stream;
    }

    if ($preset) {
      $data['preset'] = $preset;
    }
    else {
      $data['advanced'] = $advanced;
    }

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
   *   The track id.
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
        'layout' => $layout,
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
   * @param string $egressId
   *   Optional, filter by an egress ID.
   * @param bool $active
   *   Optional, list active egress only.
   *
   * @return \Livekit\ListEgressResponse
   */
  public function listEgress(
    string $roomName = '',
    string $egressId = '',
    bool $active = FALSE
  ): ListEgressResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->ListEgress(
      $this->authHeader($videoGrant),
      new ListEgressRequest([
        'room_name' => $roomName,
        'egress_id' => $egressId,
        'active' => $active,
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
