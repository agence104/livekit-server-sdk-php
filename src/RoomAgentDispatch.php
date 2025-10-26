<?php

namespace Agence104\LiveKit;

/**
 * Defines the room agent dispatch configuration.
 */
class RoomAgentDispatch {

  /**
   * The name of the agent to dispatch.
   */
  protected ?string $agentName = NULL;

  /**
   * Metadata to pass to the agent.
   */
  protected ?string $metadata = NULL;

  /**
   * RoomAgentDispatch class constructor.
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
   * Get the agent name.
   *
   * @return string|null
   *   The agent name.
   */
  public function getAgentName(): ?string {
    return $this->agentName;
  }

  /**
   * Set the agent name.
   *
   * @param string|null $agentName
   *   The agent name.
   *
   * @return $this
   */
  public function setAgentName(?string $agentName): self {
    $this->agentName = $agentName;
    return $this;
  }

  /**
   * Get the metadata.
   *
   * @return string|null
   *   The metadata.
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * Set the metadata.
   *
   * @param string|null $metadata
   *   The metadata.
   *
   * @return $this
   */
  public function setMetadata(?string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   *   The object properties.
   */
  public function getData(): array {
    return array_filter(
      get_object_vars($this),
      function ($v) {
        return !is_null($v);
      }
    );
  }

}
