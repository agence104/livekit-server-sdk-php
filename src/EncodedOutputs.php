<?php

namespace Agence104\LiveKit;

use Livekit\EncodedFileOutput;
use Livekit\ImageOutput;
use Livekit\StreamOutput;
use Livekit\SegmentedFileOutput;

class EncodedOutputs {

  /**
   * @var \Livekit\EncodedFileOutput|null
   */
  protected $file = NULL;

  /**
   * @var \Livekit\StreamOutput|null
   */
  protected $stream = NULL;

  /**
   * @var \Livekit\SegmentedFileOutput|null
   */
  protected $segments = NULL;

  /**
   * @var \Livekit\ImageOutput|null
   */
  protected $image = NULL;

  /**
   * EncodedOutputs class constructor.
   *
   * @param array $properties
   *   A list of properties with values to assign upon initializing the class.
   */
  public function __construct(array $properties = []) {
    foreach ($properties as $property => $value) {
      if (property_exists($this, $property)) {
        $this->{$property} = $value;
      }
    }
  }

  /**
   * @param \Livekit\EncodedFileOutput $file
   *
   * @return $this
   */
  public function setFile(EncodedFileOutput $file): self {
    $this->file = $file;
    return $this;
  }

  /**
   * @return \Livekit\EncodedFileOutput | null
   */
  public function getFile(): ?EncodedFileOutput {
    return $this->file;
  }

  /**
   * @param \Livekit\StreamOutput $stream
   *
   * @return $this
   */
  public function setStream(StreamOutput $stream): self {
    $this->stream = $stream;
    return $this;
  }

  /**
   * @return \Livekit\StreamOutput | null
   */
  public function getStream(): ?StreamOutput {
    return $this->stream;
  }

  /**
   * @param \Livekit\SegmentedFileOutput $file
   *
   * @return $this
   */
  public function setSegments(SegmentedFileOutput $segments): self {
    $this->segments = $segments;
    return $this;
  }

  /**
   * @return \Livekit\SegmentedFileOutput | null
   */
  public function getSegments(): ?SegmentedFileOutput {
    return $this->segments;
  }

  /**
   * @param \Livekit\ImageOutput $file
   *
   * @return $this
   */
  public function setImage(ImageOutput $image): self {
    $this->image = $image;
    return $this;
  }

  /**
   * @return \Livekit\ImageOutput | null
   */
  public function getImage(): ?ImageOutput {
    return $this->image;
  }
}