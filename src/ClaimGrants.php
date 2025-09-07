<?php

namespace Agence104\LiveKit;

/**
 * Defines the claims and grants for the AccessToken.
 */
class ClaimGrants {

  /**
   * The display name of the participant.
   */
  protected ?string $name = NULL;

  /**
   * The Access Token Grants.
   */
  protected ?VideoGrant $videoGrant = NULL;

  /**
   * The SIP Access Token Grants.
   */
  protected ?SIPGrant $sipGrant = NULL;

  /**
   * The Access Token Grants.
   */
  protected ?string $metadata = NULL;

  /**
   * The Access Token Grants.
   */
  protected ?string $sha256 = NULL;

  /**
   * Custom attributes to be passed to participants.
   */
  protected ?array $attributes = NULL;

  /**
   * Room configuration to use if this participant initiates the room.
   */
  protected ?RoomConfiguration $roomConfig = NULL;

  /**
   * ClaimGrants class constructor.
   *
   * @param array $properties
   *   A list of properties with values to assign upon initializing the class.
   */
  public function __construct(array $properties = []) {
    foreach ($properties as $property => $value) {
      if (property_exists($this, $property)) {
        if ($property == 'videoGrant') {
          $this->{$property} = new VideoGrant($value);
        }
        elseif ($property == 'sipGrant') {
          $this->{$property} = new SIPGrant($value);
        }
        elseif ($property == 'roomConfig') {
          $this->{$property} = new RoomConfiguration($value);
        }
        else {
          $this->{$property} = $value;
        }
      }
    }
  }

  /**
   * Get the display name of the participant.
   *
   * @return string|null
   *   The display name of the participant.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Set the display name of the participant.
   *
   * @param string $name
   *   The display name of the participant.
   *
   * @return $this
   */
  public function setName(string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * Get the video grant.
   *
   * @return null|\Agence104\LiveKit\VideoGrant
   *   The video grant.
   */
  public function getVideoGrant(): ?VideoGrant {
    return $this->videoGrant;
  }

  /**
   * Set the video grant.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *   The video grant.
   *
   * @return $this
   */
  public function setVideoGrant(VideoGrant $videoGrant): self {
    $this->videoGrant = $videoGrant;
    return $this;
  }

  /**
   * Get the SIP grant.
   *
   * @return null|\Agence104\LiveKit\SIPGrant
   *   The SIP grant.
   */
  public function getSipGrant(): ?SIPGrant {
    return $this->sipGrant;
  }

  /**
   * Set the SIP grant.
   *
   * @param \Agence104\LiveKit\SIPGrant $sipGrant
   *   The SIP grant.
   *
   * @return $this
   */
  public function setSipGrant(SIPGrant $sipGrant): self {
    $this->sipGrant = $sipGrant;
    return $this;
  }

  /**
   * Get the metadata of the participant.
   *
   * @return null|string
   *   The metadata of the participant.
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * Set the metadata of the participant.
   *
   * @param string $metadata
   *   The metadata of the participant.
   *
   * @return $this
   */
  public function setMetadata(string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * Get the SHA256 hash of the AccessToken.
   *
   * @return string
   *   The SHA256 hash of the AccessToken.
   */
  public function getSha256(): string {
    return $this->sha256;
  }

  /**
   * Set the SHA256 hash of the AccessToken.
   *
   * @param string $sha256
   *   The SHA256 hash of the AccessToken.
   *
   * @return $this
   */
  public function setSha256(string $sha256): self {
    $this->sha256 = $sha256;
    return $this;
  }

  /**
   * Get the attributes of the participant.
   *
   * @return array<string, string>|null
   *   The attributes of the participant.
   */
  public function getAttributes(): ?array {
    return $this->attributes ? (array) $this->attributes : NULL;
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

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   *   The object properties as an array.
   */
  public function getData(): array {
    $data = [
      'name' => $this->name,
      'metadata' => $this->metadata,
      'sha256' => $this->sha256,
      'video' => $this->videoGrant ? $this->videoGrant->getData() : NULL,
      'sip' => $this->sipGrant ? $this->sipGrant->getData() : NULL,
      'attributes' => $this->attributes,
      'roomConfig' => $this->roomConfig ? $this->roomConfig->getData() : NULL,
    ];

    return array_filter($data);
  }

}
