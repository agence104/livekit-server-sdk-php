<?php

namespace Agence104\LiveKit;

use Livekit\EncodedFileOutput;
use Livekit\ImageOutput;
use Livekit\SegmentedFileOutput;
use Livekit\StreamOutput;

/**
 * Defines the encoded outputs for the egress.
 */
class EncodedOutputs {

  /**
   * The encoded file output.
   */
  protected ?EncodedFileOutput $file = NULL;

  /**
   * The stream output.
   */
  protected ?StreamOutput $stream = NULL;

  /**
   * The segmented file output.
   */
  protected ?SegmentedFileOutput $segments = NULL;

  /**
   * The image output.
   */
  protected ?ImageOutput $image = NULL;

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
   * Set the encoded file output.
   *
   * @param \Livekit\EncodedFileOutput $file
   *   The encoded file output.
   *
   * @return $this
   */
  public function setFile(EncodedFileOutput $file): self {
    $this->file = $file;
    return $this;
  }

  /**
   * Get the encoded file output.
   *
   * @return \Livekit\EncodedFileOutput|null
   *   The encoded file output.
   */
  public function getFile(): ?EncodedFileOutput {
    return $this->file;
  }

  /**
   * Set the stream output.
   *
   * @param \Livekit\StreamOutput $stream
   *   The stream output.
   *
   * @return $this
   */
  public function setStream(StreamOutput $stream): self {
    $this->stream = $stream;
    return $this;
  }

  /**
   * Get the stream output.
   *
   * @return \Livekit\StreamOutput|null
   *   The stream output.
   */
  public function getStream(): ?StreamOutput {
    return $this->stream;
  }

  /**
   * Set the segmented file output.
   *
   * @param \Livekit\SegmentedFileOutput $segments
   *   The segmented file output.
   *
   * @return $this
   */
  public function setSegments(SegmentedFileOutput $segments): self {
    $this->segments = $segments;
    return $this;
  }

  /**
   * Get the segmented file output.
   *
   * @return \Livekit\SegmentedFileOutput|null
   *   The segmented file output.
   */
  public function getSegments(): ?SegmentedFileOutput {
    return $this->segments;
  }

  /**
   * Set the image output.
   *
   * @param \Livekit\ImageOutput $image
   *   The image output.
   *
   * @return $this
   */
  public function setImage(ImageOutput $image): self {
    $this->image = $image;
    return $this;
  }

  /**
   * Get the image output.
   *
   * @return \Livekit\ImageOutput|null
   *   The image output.
   */
  public function getImage(): ?ImageOutput {
    return $this->image;
  }

}
