<?php

namespace Agence104\LiveKit;

class AccessTokenOptions {

  /**
   * The amount of time before expiration
   * expressed in seconds or a string describing a time span zeit/ms.
   * eg: '2 days', '10h', or seconds as numeric value
   *
   * @var numeric|string
   */
  protected $ttl;

  /**
   * The display name for the participant, available as `Participant.name`
   *
   * @var string
   */
  protected $name;


  /**
   * The Identity of the user, required for room join tokens
   *
   * @var string
   */
  protected $identity;

  /**
   * Custom metadata to be passed to participants.
   *
   * @var string
   */
  protected $metadata;

  public function setIdentity($identity) {
    $this->identity = $identity;
  }
  
  public function getIdentity() {
    return $this->identity ?? NULL;
  }

  public function setName($name) {
    $this->name = $name;
  }
  
  public function getName() {
    return $this->name ?? NULL;
  }

  public function setTtl($ttl) {
    $this->ttl = $ttl;
  }
  
  public function getTtl() {
    return $this->ttl ?? NULL;
  }

  public function setMetadata() {
    return $this->metadata ?? NULL;
  }
  
  public function getMetadata() {
    return $this->metadata ?? NULL;
  }

}
