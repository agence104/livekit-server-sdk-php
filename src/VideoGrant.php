<?php

namespace Agence104\LiveKit;

class VideoGrant {

  /**
   * Permission to create a room.
   *
   * @var bool
   */
  protected $roomCreate = FALSE;

  /**
   * Permission to join a room as a participant, room must be set.
   *
   * @var bool
   */
  protected $roomJoin = FALSE;

  /**
   * Permission to list rooms.
   *
   * @var bool
   */
  protected $roomList = FALSE;

  /**
   * Permission to start a recording.
   *
   * @var bool
   */
  protected $roomRecord = FALSE;

  /**
   * Permission to control a specific room, room must be set.
   *
   * @var bool
   */
  protected $roomAdmin = FALSE;

  /**
   * Name of the room, must be set for admin or join permissions.
   *
   * @var string
   */
  protected $room;

  /**
   * Allow participant to publish. If neither canPublish or canSubscribe is set,
   * both publish and subscribe are enabled.
   *
   * @var bool
   */
  protected $canPublish = FALSE;

  /**
   * Allow participant to subscribe to other tracks.
   *
   * @var bool
   */
  protected $canSubscribe = FALSE;

  /**
   * Allow participants to publish data, defaults to true if not set.
   *
   * @var bool
   */
  protected $canPublishData = FALSE;

  /**
   * Participant isn't visible to others.
   *
   * @var bool
   */
  protected $hidden = FALSE;

  /**
   * Participant is recording the room, when set, allows room to indicate it's
   * being recorded.
   *
   * @var bool
   */
  protected $recorder = FALSE;

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
   * @return bool
   */
  public function isRoomCreate(): bool {
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
   * @return bool
   */
  public function isRoomJoin(): bool {
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
   * @return bool
   */
  public function isRoomList(): bool {
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
   * @return bool
   */
  public function isRoomRecord(): bool {
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
   * @return bool
   */
  public function isRoomAdmin(): bool {
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
   * @return bool
   */
  public function isCanPublish(): bool {
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
   * @return bool
   */
  public function isCanSubscribe(): bool {
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
   * @return bool
   */
  public function isCanPublishData(): bool {
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
   * @return bool
   */
  public function isHidden(): bool {
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
   * @return bool
   */
  public function isRecorder(): bool {
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
    return array_filter(get_object_vars($this));
  }

}
