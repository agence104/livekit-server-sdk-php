<?php

namespace Agence104\LiveKit;

class AccessTokenOptions {

  /**
   * The amount of time before expiration
   * expressed in seconds or a string describing a time span zeit/ms.
   * eg: '2 days', '10h', or seconds as numeric value
   *
   * @var int|string
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
   * @return int|string
   */
  public function getTtl(): int|string {
    return $this->ttl;
  }

  /**
   * @param int|string $ttl
   */
  public function setTtl(int|string $ttl): void {
    $this->ttl = $ttl;
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
   * @return null|string
   */
  public function getIdentity(): ?string {
    return $this->identity;
  }

  /**
   * @param string $identity
   */
  public function setIdentity(string $identity): void {
    $this->identity = $identity;
  }

  /**
   * @return string|null
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * @param string|null $metadata
   */
  public function setMetadata(?string $metadata): void {
    $this->metadata = $metadata;
  }

}
