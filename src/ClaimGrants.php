<?php

namespace Agence104\LiveKit;

class ClaimGrants {

  /**
   * The Access Token Grants
   *
   * @var string
   */
  protected $name;

  /**
   * The Access Token Grants
   *
   * @var \Agence104\LiveKit\VideoGrant
   */
  protected $videoGrant;
  /**
   * The Access Token Grants
   *
   * @var string
   */
  protected $metadata;
  /**
   * The Access Token Grants
   *
   * @var string
   */
  protected $sha256;

  /**
   * Add Video Grant.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *
   * @return void
   */
  public function setVideoGrant($videoGrant) {
    $this->videoGrant = $videoGrant;
  }

  public function getVideoGrant($videoGrant) {
    return $this->videoGrant;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName($name) {
    return $this->name;
  }

  public function setMetaData($metadata) {
    $this->metadata = $metadata;
  }

  public function getMetaData($metadata) {
    return $this->metadata;
  }

  public function setSha256($sha) {
    $this->sha256 = $sha;
  }

  public function getSha256() {
    return $this->sha256;
  }

}
