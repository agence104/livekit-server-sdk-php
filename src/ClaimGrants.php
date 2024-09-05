<?php

namespace Agence104\LiveKit;

class ClaimGrants {

  /**
   * The display name of the participant.
   *
   * @var string
   */
  protected $name;

  /**
   * The identity of the participant.
   *
   * @var string
   */
  protected $identity;

  /**
   * The Access Token Grants.
   *
   * @var null|\Agence104\LiveKit\VideoGrant
   */
  protected $videoGrant;

  /**
   * The Access Token Grants.
   *
   * @var null|string
   */
  protected $metadata;

  /**
   * The Access Token Grants.
   *
   * @var string
   */
  protected $sha256;

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
        else {
          $this->{$property} = $value;
        }
      }
    }
  }

  /**
   * @return null|string
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * @param string $name
   *
   * @return $this
   */
  public function setName(string $name): self {
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
   * @return null|\Agence104\LiveKit\VideoGrant
   */
  public function getVideoGrant(): ?VideoGrant {
    return $this->videoGrant;
  }

  /**
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *
   * @return $this
   */
  public function setVideoGrant(VideoGrant $videoGrant): self {
    $this->videoGrant = $videoGrant;
    return $this;
  }

  /**
   * @return null|string
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * @param string $metadata
   *
   * @return $this
   */
  public function setMetadata(string $metadata): self {
    $this->metadata = $metadata;
    return $this;
  }

  /**
   * @return string
   */
  public function getSha256(): string {
    return $this->sha256;
  }

  /**
   * @param string $sha256
   *
   * @return $this
   */
  public function setSha256(string $sha256): self {
    $this->sha256 = $sha256;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData(): array {
    $data = [
      'name' => $this->name,
      'metadata' => $this->metadata,
      'sha256' => $this->sha256,
      'video' => $this->videoGrant->getData(),
    ];

    return array_filter($data);
  }

}
