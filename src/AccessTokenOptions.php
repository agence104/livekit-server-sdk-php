<?php

namespace Agence104\LiveKit;

class AccessTokenOptions {

  /**
   * The amount of time before expiration expressed in seconds as numeric value.
   *
   * @var int
   */
  protected $ttl = 4 * 60 * 60;

  /**
   * The display name for the participant, available as `Participant.name`.
   *
   * @var string|null
   */
  protected $name;

  /**
   * The Identity of the user, required for room join tokens.
   *
   * @var string
   */
  protected $identity;

  /**
   * Custom metadata to be passed to participants.
   *
   * @var string|null
   */
  protected $metadata;

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
   * @return int
   */
  public function getTtl(): int {
    return $this->ttl;
  }

  /**
   * @param int $ttl
   *
   * @return $this
   */
  public function setTtl(int $ttl): self {
    $this->ttl = $ttl;
    return $this;
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
   * @return null|string
   */
  public function getIdentity(): ?string {
    return $this->identity;
  }

  /**
   * @param string $identity
   *
   * @return $this
   */
  public function setIdentity(string $identity): self {
    $this->identity = $identity;
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

}
