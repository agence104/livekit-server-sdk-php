<?php

namespace Agence104\LiveKit;

/**
 * Defines the room configuration for the access token.
 */
class RoomConfiguration {

  /**
   * Used as ID, must be unique.
   */
  protected ?string $name = NULL;

  /**
   * Number of seconds to keep the room open if no one joins.
   */
  protected ?int $emptyTimeout = NULL;

  /**
   * Number of seconds to keep the room open after everyone leaves.
   */
  protected ?int $departureTimeout = NULL;

  /**
   * Limit number of participants that can be in a room, excluding Egress and Ingress participants.
   */
  protected ?int $maxParticipants = NULL;

  /**
   * Playout delay of subscriber.
   */
  protected ?int $minPlayoutDelay = NULL;

  /**
   * Maximum playout delay.
   */
  protected ?int $maxPlayoutDelay = NULL;

  /**
   * Improves A/V sync when playout_delay set to a value larger than 200ms.
   * It will disable transceiver re-use so not recommended for rooms with frequent subscription changes.
   */
  protected ?bool $syncStreams = NULL;

  /**
   * Define agents that should be dispatched to this room.
   *
   * @var \Agence104\LiveKit\RoomAgentDispatch[]|null
   */
  protected ?array $agents = NULL;

  /**
   * RoomConfiguration class constructor.
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
   * Get the room name.
   *
   * @return string|null
   *   The room name.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Set the room name.
   *
   * @param string|null $name
   *   The room name.
   *
   * @return $this
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * Get the empty timeout.
   *
   * @return int|null
   *   The empty timeout in seconds.
   */
  public function getEmptyTimeout(): ?int {
    return $this->emptyTimeout;
  }

  /**
   * Set the empty timeout.
   *
   * @param int|null $emptyTimeout
   *   The empty timeout in seconds.
   *
   * @return $this
   */
  public function setEmptyTimeout(?int $emptyTimeout): self {
    $this->emptyTimeout = $emptyTimeout;
    return $this;
  }

  /**
   * Get the departure timeout.
   *
   * @return int|null
   *   The departure timeout in seconds.
   */
  public function getDepartureTimeout(): ?int {
    return $this->departureTimeout;
  }

  /**
   * Set the departure timeout.
   *
   * @param int|null $departureTimeout
   *   The departure timeout in seconds.
   *
   * @return $this
   */
  public function setDepartureTimeout(?int $departureTimeout): self {
    $this->departureTimeout = $departureTimeout;
    return $this;
  }

  /**
   * Get the maximum participants.
   *
   * @return int|null
   *   The maximum participants.
   */
  public function getMaxParticipants(): ?int {
    return $this->maxParticipants;
  }

  /**
   * Set the maximum participants.
   *
   * @param int|null $maxParticipants
   *   The maximum participants.
   *
   * @return $this
   */
  public function setMaxParticipants(?int $maxParticipants): self {
    $this->maxParticipants = $maxParticipants;
    return $this;
  }

  /**
   * Get the minimum playout delay.
   *
   * @return int|null
   *   The minimum playout delay.
   */
  public function getMinPlayoutDelay(): ?int {
    return $this->minPlayoutDelay;
  }

  /**
   * Set the minimum playout delay.
   *
   * @param int|null $minPlayoutDelay
   *   The minimum playout delay.
   *
   * @return $this
   */
  public function setMinPlayoutDelay(?int $minPlayoutDelay): self {
    $this->minPlayoutDelay = $minPlayoutDelay;
    return $this;
  }

  /**
   * Get the maximum playout delay.
   *
   * @return int|null
   *   The maximum playout delay.
   */
  public function getMaxPlayoutDelay(): ?int {
    return $this->maxPlayoutDelay;
  }

  /**
   * Set the maximum playout delay.
   *
   * @param int|null $maxPlayoutDelay
   *   The maximum playout delay.
   *
   * @return $this
   */
  public function setMaxPlayoutDelay(?int $maxPlayoutDelay): self {
    $this->maxPlayoutDelay = $maxPlayoutDelay;
    return $this;
  }

  /**
   * Check if sync streams is enabled.
   *
   * @return bool|null
   *   The sync streams setting.
   */
  public function isSyncStreams(): ?bool {
    return $this->syncStreams;
  }

  /**
   * Set the sync streams setting.
   *
   * @param bool|null $syncStreams
   *   The sync streams setting.
   *
   * @return $this
   */
  public function setSyncStreams(?bool $syncStreams): self {
    $this->syncStreams = $syncStreams;
    return $this;
  }

  /**
   * Get the agents that should be dispatched to this room.
   *
   * @return \Agence104\LiveKit\RoomAgentDispatch[]|null
   *   The agents array.
   */
  public function getAgents(): ?array {
    return $this->agents;
  }

  /**
   * Set the agents that should be dispatched to this room.
   *
   * @param \Agence104\LiveKit\RoomAgentDispatch[]|null $agents
   *   The agents array.
   *
   * @return $this
   */
  public function setAgents(?array $agents): self {
    $this->agents = $agents;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   *   The object properties.
   */
  public function getData(): array {
    $data = [];
    $vars = get_object_vars($this);

    foreach ($vars as $key => $value) {
      if ($value !== null) {
        if ($key === 'agents' && is_array($value)) {
          $data[$key] = [];
          foreach ($value as $agent) {
            $data[$key][] = $agent->getData();
          }
        } else {
          $data[$key] = $value;
        }
      }
    }

    return $data;
  }

}
