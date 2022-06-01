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
   */
  public function setRoomCreate(bool $roomCreate = TRUE): void {
    $this->roomCreate = $roomCreate;
  }

  /**
   * @return bool
   */
  public function isRoomJoin(): bool {
    return $this->roomJoin;
  }

  /**
   * @param bool $roomJoin
   */
  public function setRoomJoin(bool $roomJoin = TRUE): void {
    $this->roomJoin = $roomJoin;
  }

  /**
   * @return bool
   */
  public function isRoomList(): bool {
    return $this->roomList;
  }

  /**
   * @param bool $roomList
   */
  public function setRoomList(bool $roomList = TRUE): void {
    $this->roomList = $roomList;
  }

  /**
   * @return bool
   */
  public function isRoomRecord(): bool {
    return $this->roomRecord;
  }

  /**
   * @param bool $roomRecord
   */
  public function setRoomRecord(bool $roomRecord = TRUE): void {
    $this->roomRecord = $roomRecord;
  }

  /**
   * @return bool
   */
  public function isRoomAdmin(): bool {
    return $this->roomAdmin;
  }

  /**
   * @param bool $roomAdmin
   */
  public function setRoomAdmin(bool $roomAdmin = TRUE): void {
    $this->roomAdmin = $roomAdmin;
  }

  /**
   * @return string
   */
  public function getRoom(): string {
    return $this->room;
  }

  /**
   * @param string $roomName
   */
  public function setRoomName(string $roomName): void {
    $this->room = $roomName;
  }

  /**
   * @return bool
   */
  public function isCanPublish(): bool {
    return $this->canPublish;
  }

  /**
   * @param bool $canPublish
   */
  public function setCanPublish(bool $canPublish = TRUE): void {
    $this->canPublish = $canPublish;
  }

  /**
   * @return bool
   */
  public function isCanSubscribe(): bool {
    return $this->canSubscribe;
  }

  /**
   * @param bool $canSubscribe
   */
  public function setCanSubscribe(bool $canSubscribe = TRUE): void {
    $this->canSubscribe = $canSubscribe;
  }

  /**
   * @return bool
   */
  public function isCanPublishData(): bool {
    return $this->canPublishData;
  }

  /**
   * @param bool $canPublishData
   */
  public function setCanPublishData(bool $canPublishData = TRUE): void {
    $this->canPublishData = $canPublishData;
  }

  /**
   * @return bool
   */
  public function isHidden(): bool {
    return $this->hidden;
  }

  /**
   * @param bool $hidden
   */
  public function setHidden(bool $hidden = TRUE): void {
    $this->hidden = $hidden;
  }

  /**
   * @return bool
   */
  public function isRecorder(): bool {
    return $this->recorder;
  }

  /**
   * @param bool $recorder
   */
  public function setRecorder(bool $recorder = TRUE): void {
    $this->recorder = $recorder;
  }

  /**
   * Return the object properties which have been defined as an array.
   *
   * @return array
   */
  public function getData() {
    return array_filter(get_object_vars($this));
  }

}
