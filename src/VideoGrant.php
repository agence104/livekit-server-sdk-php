<?php

namespace Agence104\LiveKit;

class VideoGrant {

  /**
   * Permission to create a room.
   *
   * @var bool|null
   */
  protected $roomCreate = NULL;

  /**
   * Permission to join a room as a participant, room must be set.
   *
   * @var bool|null
   */
  protected $roomJoin = NULL;

  /**
   * Permission to list rooms.
   *
   * @var bool|null
   */
  protected $roomList = NULL;

  /**
   * Permission to start a recording.
   *
   * @var bool|null
   */
  protected $roomRecord = NULL;

  /**
   * Permission to control a specific room, room must be set.
   *
   * @var bool|null
   */
  protected $roomAdmin = NULL;

  /**
   * Name of the room, must be set for admin or join permissions.
   *
   * @var string
   */
  protected $room;

  /**
   * Permissions to control ingress, not specific to any room or ingress.
   *
   * @var bool|null
   */
  protected $ingressAdmin = NULL;

  /**
   * Allow participant to publish. If neither canPublish or canSubscribe is set,
   * both publish and subscribe are enabled.
   *
   * @var bool|null
   */
  protected $canPublish = NULL;

  /**
   * Allow participant to subscribe to other tracks.
   *
   * @var bool|null
   */
  protected $canSubscribe = NULL;

  /**
   * Allow participants to publish data, defaults to true if not set.
   *
   * @var bool|null
   */
  protected $canPublishData = NULL;

  /**
   * When set, only listed source can be published.
   * (camera, microphone, screen_share, screen_share_audio)
   *
   * @var string[]|null
   */
  protected $canPublishSources = NULL;

  /**
   * Allow participant to update its own metadata
   *
   * @var bool|null
   */
  protected $canUpdateOwnMetadata = NULL;

  /**
   * Participant isn't visible to others.
   *
   * @var bool|null
   */
  protected $hidden = NULL;

  /**
   * Participant is recording the room, when set, allows room to indicate it's
   * being recorded.
   *
   * @var bool|null
   */
  protected $recorder = NULL;

  /**
   * VideoGrant class constructor.
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
   * @return bool | null
   */
  public function isRoomCreate(): bool | null {
    return $this->roomCreate;
  }

  /**
   * @param bool $roomCreate
   *
   * @return $this
   */
  public function setRoomCreate(bool $roomCreate = TRUE): self {
    $this->roomCreate = $roomCreate;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isRoomJoin(): bool | null {
    return $this->roomJoin;
  }

  /**
   * @param bool $roomJoin
   *
   * @return $this
   */
  public function setRoomJoin(bool $roomJoin = TRUE): self {
    $this->roomJoin = $roomJoin;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isRoomList(): bool | null {
    return $this->roomList;
  }

  /**
   * @param bool $roomList
   *
   * @return $this
   */
  public function setRoomList(bool $roomList = TRUE): self {
    $this->roomList = $roomList;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isRoomRecord(): bool | null {
    return $this->roomRecord;
  }

  /**
   * @param bool $roomRecord
   *
   * @return $this
   */
  public function setRoomRecord(bool $roomRecord = TRUE): self {
    $this->roomRecord = $roomRecord;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isRoomAdmin(): bool | null {
    return $this->roomAdmin;
  }

  /**
   * @param bool $roomAdmin
   *
   * @return $this
   */
  public function setRoomAdmin(bool $roomAdmin = TRUE): self {
    $this->roomAdmin = $roomAdmin;
    return $this;
  }

  /**
   * @return string
   */
  public function getRoom(): string {
    return $this->room;
  }

  /**
   * @param string $roomName
   *
   * @return $this
   */
  public function setRoomName(string $roomName): self {
    $this->room = $roomName;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isIngressAdmin(): bool | null {
    return $this->ingressAdmin;
  }

  /**
   * @param bool $ingressAdmin
   *
   * @return $this
   */
  public function setIngressAdmin(bool $ingressAdmin = TRUE): self {
    $this->ingressAdmin = $ingressAdmin;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isCanPublish(): bool | null {
    return $this->canPublish;
  }

  /**
   * @param bool $canPublish
   *
   * @return $this
   */
  public function setCanPublish(bool $canPublish = TRUE): self {
    $this->canPublish = $canPublish;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isCanSubscribe(): bool | null {
    return $this->canSubscribe;
  }

  /**
   * @param bool $canSubscribe
   *
   * @return $this
   */
  public function setCanSubscribe(bool $canSubscribe = TRUE): self {
    $this->canSubscribe = $canSubscribe;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isCanPublishData(): bool | null {
    return $this->canPublishData;
  }

  /**
   * @param bool $canPublishData
   *
   * @return $this
   */
  public function setCanPublishData(bool $canPublishData = TRUE): self {
    $this->canPublishData = $canPublishData;
    return $this;
  }

  /**
   * @param string[] $canPublishSources
   *
   * @return $this
   */
  public function setCanPublishSources(array $canPublishSources = []): self {
    $this->canPublishSources = $canPublishSources;
    return $this;
  }

  /**
   * @return string[]|null
   */
  public function getCanPublishSources(): array | null {
    return $this->canPublishSources;
  }

  /**
   * @return bool | null
   */
  public function isCanUpdateOwnMetadata(): bool | null {
    return $this->canUpdateOwnMetadata;
  }

  /**
   * @param bool $canUpdateOwnMetadata
   *
   * @return $this
   */
  public function setCanUpdateOwnMetadata(bool $canUpdateOwnMetadata = TRUE): self {
    $this->canUpdateOwnMetadata = $canUpdateOwnMetadata;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isHidden(): bool | null {
    return $this->hidden;
  }

  /**
   * @param bool $hidden
   *
   * @return $this
   */
  public function setHidden(bool $hidden = TRUE): self {
    $this->hidden = $hidden;
    return $this;
  }

  /**
   * @return bool | null
   */
  public function isRecorder(): bool | null {
    return $this->recorder;
  }

  /**
   * @param bool $recorder
   *
   * @return $this
   */
  public function setRecorder(bool $recorder = TRUE): self {
    $this->recorder = $recorder;
    return $this;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData(): array {
    return array_filter(
      get_object_vars($this),
      function ($v) { return !is_null($v); }
    );
  }

}
