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
   * @var string
   */
  protected $emptyTimeout;

  /**
   * The limit to the number of participants in a room at a time.
   *
   * @var integer|null
   */
  protected $maxParticipants;

  /**
   * The Node ID to override the node room is allocated to, for debugging.
   *
   * @var string|null
   */
  protected $nodeId;

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
   * @return string
   */
  public function getEmptyTimeout(): string {
    return $this->emptyTimeout;
  }

  /**
   * @param string $emptyTimeout
   */
  public function setEmptyTimeout(string $emptyTimeout): void {
    $this->emptyTimeout = $emptyTimeout;
  }

  /**
   * @return int|null
   */
  public function getMaxParticipants(): ?int {
    return $this->maxParticipants;
  }

  /**
   * @param int|null $maxParticipants
   */
  public function setMaxParticipants(?int $maxParticipants): void {
    $this->maxParticipants = $maxParticipants;
  }

  /**
   * @return string|null
   */
  public function getNodeId(): ?string {
    return $this->nodeId;
  }

  /**
   * @param string|null $nodeId
   */
  public function setNodeId(?string $nodeId): void {
    $this->nodeId = $nodeId;
  }

}
