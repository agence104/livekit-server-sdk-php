<?php

namespace Agence104\LiveKit;

use Agence104\LiveKit\Traits\CaseConverter;
use Livekit\RoomEgress;

/**
 * Defines the options for creating a room.
 */
class RoomCreateOptions {
  use CaseConverter;

  /**
   * The name of the room.
   */
  protected ?string $name = NULL;

  /**
   * The number of seconds the room should cleanup after being empty.
   */
  protected ?int $emptyTimeout = NULL;

  /**
   * The limit to the number of participants in a room at a time.
   */
  protected ?int $maxParticipants = NULL;

  /**
   * The Node ID to override the node room is allocated to, for debugging.
   */
  protected ?string $nodeId = NULL;

  /**
   * The metadata of the room.
   */
  protected ?string $metadata = NULL;

  /**
   * The egress of the room.
   */
  protected ?RoomEgress $egress = NULL;

  /**
   * The minimum playout delay for subscribers.
   */
  protected ?int $minPlayoutDelay = NULL;

  /**
   * The maximum playout delay for subscribers.
   */
  protected ?int $maxPlayoutDelay = NULL;

  /**
   * The flag enhances A/V synchronization when the playout delay exceeds 200ms.
   *
   * However, it deactivates the re-utilization of the transceiver, hence
   * it's not advisable for rooms that often modify subscriptions.
   */
  protected ?bool $syncStreams = NULL;

  /**
   * RoomCreateOptions class constructor.
   *
   * @param array $properties
   *   A list of properties with values to assign upon initializing the class.
   */
  public function __construct(array $properties = []) {
    // Convert snake_case keys to camelCase for backward compatibility.
    $properties = $this->convertArrayKeysToCamel($properties);

    foreach ($properties as $property => $value) {
      if (property_exists($this, $property)) {
        $this->{$property} = $value;
      }
    }
  }

  /**
   * Get the room name.
   *
   * @return string|null
   *   The room name or null if not set.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Set the room name.
   *
   * @param string|null $name
   *   The room name to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * Get the empty timeout value.
   *
   * @return int|null
   *   The number of seconds before an empty room is cleaned up.
   */
  public function getEmptyTimeout(): ?int {
    return $this->emptyTimeout;
  }

  /**
   * Set the empty timeout value.
   *
   * @param int|null $emptyTimeout
   *   The number of seconds before an empty room is cleaned up.
   *
   * @return $this
   *   The current instance.
   */
  public function setEmptyTimeout(?int $emptyTimeout): self {
    $this->emptyTimeout = $emptyTimeout;
    return $this;
  }

  /**
   * Get the maximum number of participants allowed.
   *
   * @return int|null
   *   The maximum number of participants allowed in the room.
   */
  public function getMaxParticipants(): ?int {
    return $this->maxParticipants;
  }

  /**
   * Set the maximum number of participants allowed.
   *
   * @param int|null $maxParticipants
   *   The maximum number of participants allowed in the room.
   *
   * @return $this
   *   The current instance.
   */
  public function setMaxParticipants(?int $maxParticipants): self {
    $this->maxParticipants = $maxParticipants;
    return $this;
  }

  /**
   * Get the Node ID.
   *
   * @return string|null
   *   The Node ID or null if not set.
   */
  public function getNodeId(): ?string {
    return $this->nodeId;
  }

  /**
   * Set the Node ID.
   *
   * @param string|null $nodeId
   *   The Node ID to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setNodeId(?string $nodeId): self {
    $this->nodeId = $nodeId;
    return $this;
  }

  /**
   * Get the metadata of the room.
   *
   * @return string|null
   *   The metadata of the room or null if not set.
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * Set the metadata of the room.
   *
   * @param string|null $metadata
   *   The metadata of the room to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setMetadata(?string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * Get the egress of the room.
   *
   * @return \Livekit\RoomEgress|null
   *   The egress of the room or null if not set.
   */
  public function getEgress(): ?RoomEgress {
    return $this->egress;
  }

  /**
   * Set the egress of the room.
   *
   * @param \Livekit\RoomEgress|null $egress
   *   The egress of the room to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setEgress(?RoomEgress $egress): self {
    $this->egress = $egress;
    return $this;
  }

  /**
   * Get the minimum playout delay.
   *
   * @return int|null
   *   The minimum playout delay or null if not set.
   */
  public function getMinPlayoutDelay(): ?int {
    return $this->minPlayoutDelay;
  }

  /**
   * Set the minimum playout delay.
   *
   * @param int|null $minPlayoutDelay
   *   The minimum playout delay to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setMinPlayoutDelay(?int $minPlayoutDelay): self {
    $this->minPlayoutDelay = $minPlayoutDelay;
    return $this;
  }

  /**
   * Get the maximum playout delay.
   *
   * @return int|null
   *   The maximum playout delay or null if not set.
   */
  public function getMaxPlayoutDelay(): ?int {
    return $this->maxPlayoutDelay;
  }

  /**
   * Set the maximum playout delay.
   *
   * @param int|null $maxPlayoutDelay
   *   The maximum playout delay to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setMaxPlayoutDelay(?int $maxPlayoutDelay): self {
    $this->maxPlayoutDelay = $maxPlayoutDelay;
    return $this;
  }

  /**
   * Get the sync streams flag.
   *
   * @return bool|null
   *   The sync streams flag or null if not set.
   */
  public function getSyncStreams(): ?bool {
    return $this->syncStreams;
  }

  /**
   * Set the sync streams flag.
   *
   * @param bool|null $syncStreams
   *   The sync streams flag to set.
   *
   * @return $this
   *   The current instance.
   */
  public function setSyncStreams(?bool $syncStreams): self {
    $this->syncStreams = $syncStreams;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   *   An array of defined properties in snake_case format.
   */
  public function getData(): array {
    if (!$this->name) {
      throw new \Exception('The name of the room is required.');
    }

    $data = array_filter(get_object_vars($this));
    return $this->convertArrayKeysToSnake($data);
  }

}
