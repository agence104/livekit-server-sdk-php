<?php

namespace Agence104\LiveKit;

/**
 * Defines the options for the AccessToken.
 */
class AccessTokenOptions {

  /**
   * The amount of time before expiration expressed in seconds as numeric value.
   */
  protected ?int $ttl = NULL;

  /**
   * The display name for the participant, available as `Participant.name`.
   */
  protected ?string $name = NULL;

  /**
   * The Identity of the user, required for room join tokens.
   */
  protected ?string $identity = NULL;

  /**
   * Custom metadata to be passed to participants.
   */
  protected ?string $metadata = NULL;

  /**
   * Custom attributes to be passed to participants.
   */
  protected ?array $attributes = NULL;

  /**
   * Room configuration settings.
   */
  protected ?RoomConfiguration $roomConfig = NULL;

  /**
   * AccessTokenOptions class constructor.
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
   * Get the time to live of the token.
   *
   * @return int|null
   *   The time to live of the token.
   */
  public function getTtl(): ?int {
    return $this->ttl;
  }

  /**
   * Set the time to live of the token.
   *
   * @param int $ttl
   *   The time to live of the token.
   *
   * @return $this
   */
  public function setTtl(int $ttl): self {
    $this->ttl = $ttl;
    return $this;
  }

  /**
   * Get the display name for the participant.
   *
   * @return string|null
   *   The display name for the participant.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Set the display name for the participant.
   *
   * @param string|null $name
   *   The display name for the participant.
   *
   * @return $this
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * Get the identity of the participant.
   *
   * @return string|null
   *   The identity of the participant.
   */
  public function getIdentity(): ?string {
    return $this->identity;
  }

  /**
   * Set the identity of the participant.
   *
   * @param string $identity
   *   The identity of the participant.
   *
   * @return $this
   */
  public function setIdentity(string $identity): self {
    $this->identity = $identity;
    return $this;
  }

  /**
   * Get the metadata of the participant.
   *
   * @return string|null
   *   The metadata of the participant.
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * Set the metadata of the participant.
   *
   * @param string|null $metadata
   *   The metadata of the participant.
   *
   * @return $this
   */
  public function setMetadata(?string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * Get the attributes of the participant.
   *
   * @return array<string, string>|null
   *   The attributes of the participant.
   */
  public function getAttributes(): ?array {
    return $this->attributes;
  }

  /**
   * Set the attributes of the participant.
   *
   * @param array<string, string>|null $attributes
   *   The attributes of the participant.
   *
   * @return $this
   */
  public function setAttributes(?array $attributes): self {
    $this->attributes = $attributes;
    return $this;
  }

  /**
   * Get the room configuration.
   *
   * @return \Agence104\LiveKit\RoomConfiguration|null
   *   The room configuration.
   */
  public function getRoomConfig(): ?RoomConfiguration {
    return $this->roomConfig;
  }

  /**
   * Set the room configuration.
   *
   * @param \Agence104\LiveKit\RoomConfiguration|null $roomConfig
   *   The room configuration.
   *
   * @return $this
   */
  public function setRoomConfig(?RoomConfiguration $roomConfig): self {
    $this->roomConfig = $roomConfig;
    return $this;
  }

}
