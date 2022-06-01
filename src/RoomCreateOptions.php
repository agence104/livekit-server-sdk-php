<?php

namespace Agence104\LiveKit;

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
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData(): array {
    return array_filter(get_object_vars($this));
  }

}
