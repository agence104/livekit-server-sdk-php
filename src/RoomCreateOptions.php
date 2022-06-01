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
   */
  public function setName(?string $name): void {
    $this->name = $name;
  }

  /**
   * @return int|null
   */
  public function getEmptyTimeout(): ?int {
    return $this->empty_timeout;
  }

  /**
   * @param int|null $emptyTimeout
   */
  public function setEmptyTimeout(?int $emptyTimeout): void {
    $this->empty_timeout = $emptyTimeout;
  }

  /**
   * @return int|null
   */
  public function getMaxParticipants(): ?int {
    return $this->max_participants;
  }

  /**
   * @param int|null $maxParticipants
   */
  public function setMaxParticipants(?int $maxParticipants): void {
    $this->max_participants = $maxParticipants;
  }

  /**
   * @return string|null
   */
  public function getNodeId(): ?string {
    return $this->node_id;
  }

  /**
   * @param string|null $nodeId
   */
  public function setNodeId(?string $nodeId): void {
    $this->node_id = $nodeId;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData() {
    return array_filter(get_object_vars($this));
  }

}
