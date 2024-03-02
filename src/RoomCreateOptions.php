<?php

namespace Agence104\LiveKit;

use \Livekit\RoomEgress;

class RoomCreateOptions {

  /**
   * The name of the room. required property
   *
   * @var string|null
   */
  protected $name;

  /**
   * The number of seconds the room should cleanup after being empty.
   *
   * @var integer|null
   */
  protected $empty_timeout;

  /**
   * The limit to the number of participants in a room at a time.
   *
   * @var integer|null
   */
  protected $max_participants;

  /**
   * The Node ID to override the node room is allocated to, for debugging.
   *
   * @var string|null
   */
  protected $node_id;

  /**
   * The metadata of the room.
   *
   * @var string|null
   */
  protected $metadata;

  /**
   * The egress of the room.
   *
   * @var \Livekit\RoomEgress|null
   */
  protected $egress;

  /**
   * The minimum playout delay for subscribers.
   *
   * @var int|null
   */
  protected $min_playout_delay;

  /**
   * The maximum playout delay for subscribers.
   *
   * @var int|null
   */
  protected $max_playout_delay;

  /**
   * The flag enhances A/V synchronization when the `playout_delay` exceeds
   * 200ms. However, it deactivates the re-utilization of the transceiver, hence
   * it's not advisable for rooms that often modify subscriptions.
   *
   * @var bool|null
   */
  protected $sync_streams;

  /**
   * RoomCreateOptions class constructor.
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
   * @return string|null
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * @param string|null $name
   *
   * @return $this
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * @return int|null
   */
  public function getEmptyTimeout(): ?int {
    return $this->empty_timeout;
  }

  /**
   * @param int|null $emptyTimeout
   *
   * @return $this
   */
  public function setEmptyTimeout(?int $emptyTimeout): self {
    $this->empty_timeout = $emptyTimeout;
    return $this;
  }

  /**
   * @return int|null
   */
  public function getMaxParticipants(): ?int {
    return $this->max_participants;
  }

  /**
   * @param int|null $maxParticipants
   *
   * @return $this
   */
  public function setMaxParticipants(?int $maxParticipants): self {
    $this->max_participants = $maxParticipants;
    return $this;
  }

  /**
   * @return string|null
   */
  public function getNodeId(): ?string {
    return $this->node_id;
  }

  /**
   * @param string|null $nodeId
   *
   * @return $this
   */
  public function setNodeId(?string $nodeId): self {
    $this->node_id = $nodeId;
    return $this;
  }

  /**
   * @return string|null
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * @param string|null $metadata
   *
   * @return $this
   */
  public function setMetadata(?string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * @return \Livekit\RoomEgress|null
   */
  public function getEgress(): ?RoomEgress {
    return $this->egress;
  }

  /**
   * @param \Livekit\RoomEgress|null $egress
   *
   * @return $this
   */
  public function setEgress(?RoomEgress $egress): self {
    $this->egress = $egress;
    return $this;
  }

  /**
   * @return int|null
   */
  public function getMinPlayoutDelay(): ?int {
    return $this->min_playout_delay;
  }

  /**
   * @param int|null $minPlayoutDelay
   *
   * @return $this
   */
  public function setMinPlayoutDelay(?int $minPlayoutDelay): self {
    $this->min_playout_delay = $minPlayoutDelay;
    return $this;
  }

  /**
   * @return int|null
   */
  public function getMaxPlayoutDelay(): ?int {
    return $this->max_playout_delay;
  }

  /**
   * @param int|null $maxPlayoutDelay
   *
   * @return $this
   */
  public function setMaxPlayoutDelay(?int $maxPlayoutDelay): self {
    $this->max_playout_delay = $maxPlayoutDelay;
    return $this;
  }

  /**
   * @return bool|null
   */
  public function getSyncStream(): ?bool {
    return $this->sync_streams;
  }

  /**
   * @param bool|null $syncStream
   *
   * @return $this
   */
  public function setSyncStream(?bool $syncStream): self {
    $this->sync_streams = $syncStream;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData(): array {
    return array_filter(get_object_vars($this));
  }

}
