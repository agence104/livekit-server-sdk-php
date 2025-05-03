<?php

namespace Agence104\LiveKit;

/**
 * Defines the SIP grant for the access token.
 */
class SIPGrant {

  /**
   * Permission to manage SIP trunks and dispatch rules.
   */
  protected ?bool $admin = NULL;

  /**
   * Permission to make SIP calls via CreateSIPParticipant.
   */
  protected ?bool $call = NULL;

  /**
   * SIPGrant class constructor.
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
   * Check if the admin permission is set.
   *
   * @return bool|null
   *   The admin permission value.
   */
  public function isAdmin(): ?bool {
    return $this->admin;
  }

  /**
   * Set the admin permission.
   *
   * @param bool $admin
   *   The admin permission value.
   *
   * @return $this
   */
  public function setAdmin(bool $admin = TRUE): self {
    $this->admin = $admin;
    return $this;
  }

  /**
   * Check if the call permission is set.
   *
   * @return bool|null
   *   The call permission value.
   */
  public function isCall(): ?bool {
    return $this->call;
  }

  /**
   * Set the call permission.
   *
   * @param bool $call
   *   The call permission value.
   *
   * @return $this
   */
  public function setCall(bool $call = TRUE): self {
    $this->call = $call;
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
