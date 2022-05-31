<?php

namespace Agence104\LiveKit;

class ClaimGrants {

  /**
   * The display name for the participant.
   *
   * @var string
   */
  protected $name;

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
   * @return null|string
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name): void {
    $this->name = $name;
  }

  /**
   * @return \Agence104\LiveKit\VideoGrant
   */
  public function getVideoGrant() {
    return $this->videoGrant;
  }

  /**
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   */
  public function setVideoGrant(VideoGrant $videoGrant): void {
    $this->videoGrant = $videoGrant;
  }

  /**
   * @return null|string
   */
  public function getMetadata(): ?string {
    return $this->metadata;
  }

  /**
   * @param string $metadata
   */
  public function setMetadata(string $metadata): void {
    $this->metadata = $metadata;
  }

  /**
   * @return string
   */
  public function getSha256(): string {
    return $this->sha256;
  }

  /**
   * @param string $sha256
   */
  public function setSha256(string $sha256): void {
    $this->sha256 = $sha256;
  }

}
