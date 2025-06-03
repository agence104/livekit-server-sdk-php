<?php

namespace Agence104\LiveKit;

/**
 * Defines the video grant for the access token.
 */
class VideoGrant {

  /**
   * Permission to create a room.
   */
  protected ?bool $roomCreate = NULL;

  /**
   * Permission to join a room as a participant, room must be set.
   */
  protected ?bool $roomJoin = NULL;

  /**
   * Permission to list rooms.
   */
  protected ?bool $roomList = NULL;

  /**
   * Permission to start a recording.
   */
  protected ?bool $roomRecord = NULL;

  /**
   * Permission to control a specific room, room must be set.
   */
  protected ?bool $roomAdmin = NULL;

  /**
   * Name of the room, must be set for admin or join permissions.
   */
  protected ?string $room;

  /**
   * Permissions to control ingress, not specific to any room or ingress.
   */
  protected ?bool $ingressAdmin = NULL;

  /**
   * Allow participant to publish.
   *
   * If neither canPublish or canSubscribe is set, both publish and
   * subscribe are enabled.
   */
  protected ?bool $canPublish = NULL;

  /**
   * Allow participant to subscribe to other tracks.
   */
  protected ?bool $canSubscribe = NULL;

  /**
   * Allow participants to publish data, defaults to true if not set.
   */
  protected ?bool $canPublishData = NULL;

  /**
   * When set, only listed source can be published.
   *
   * (camera, microphone, screen_share, screen_share_audio)
   */
  protected ?array $canPublishSources = NULL;

  /**
   * Allow participant to update its own metadata.
   */
  protected ?bool $canUpdateOwnMetadata = NULL;

  /**
   * Participant isn't visible to others.
   */
  protected ?bool $hidden = NULL;

  /**
   * Participant is recording the room, allowing indication of recording status.
   */
  protected ?bool $recorder = NULL;

  /**
   * If a participant can subscribe to metrics.
   */
  protected ?bool $canSubscribeMetrics = NULL;

  /**
   * Destination room which this participant can forward to.
   */
  protected ?string $destinationRoom = NULL;

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
   * Check if the room create permission is set.
   *
   * @return bool|null
   *   The room create permission value.
   */
  public function isRoomCreate(): ?bool {
    return $this->roomCreate;
  }

  /**
   * Set the room create permission.
   *
   * @param bool $roomCreate
   *   The flag to set the room create permission for the participant.
   *
   * @return $this
   */
  public function setRoomCreate(bool $roomCreate = TRUE): self {
    $this->roomCreate = $roomCreate;
    return $this;
  }

  /**
   * Check if the room join permission is set.
   *
   * @return bool|null
   *   The room join permission value.
   */
  public function isRoomJoin(): ?bool {
    return $this->roomJoin;
  }

  /**
   * Set the room join permission.
   *
   * @param bool $roomJoin
   *   The room join permission flag.
   *
   * @return $this
   */
  public function setRoomJoin(bool $roomJoin = TRUE): self {
    $this->roomJoin = $roomJoin;
    return $this;
  }

  /**
   * Check if the room list permission is set.
   *
   * @return bool|null
   *   The room list permission value.
   */
  public function isRoomList(): ?bool {
    return $this->roomList;
  }

  /**
   * Set the room list permission.
   *
   * @param bool $roomList
   *   The room list permission value.
   *
   * @return $this
   */
  public function setRoomList(bool $roomList = TRUE): self {
    $this->roomList = $roomList;
    return $this;
  }

  /**
   * Check if the room record permission is set.
   *
   * @return bool|null
   *   The room record permission value.
   */
  public function isRoomRecord(): ?bool {
    return $this->roomRecord;
  }

  /**
   * Set the room record permission.
   *
   * @param bool $roomRecord
   *   The room record permission flag.
   *
   * @return $this
   */
  public function setRoomRecord(bool $roomRecord = TRUE): self {
    $this->roomRecord = $roomRecord;
    return $this;
  }

  /**
   * Check if the room admin permission is set.
   *
   * @return bool|null
   *   The room admin permission value.
   */
  public function isRoomAdmin(): ?bool {
    return $this->roomAdmin;
  }

  /**
   * Set the room admin permission.
   *
   * @param bool $roomAdmin
   *   The room admin permission value.
   *
   * @return $this
   */
  public function setRoomAdmin(bool $roomAdmin = TRUE): self {
    $this->roomAdmin = $roomAdmin;
    return $this;
  }

  /**
   * Get the room name.
   *
   * @return string|null
   *   The room name.
   */
  public function getRoom(): ?string {
    return $this->room;
  }

  /**
   * Set the room name.
   *
   * @param string $roomName
   *   The room name.
   *
   * @return $this
   */
  public function setRoomName(string $roomName): self {
    $this->room = $roomName;
    return $this;
  }

  /**
   * Check if the ingress admin permission is set.
   *
   * @return bool|null
   *   The ingress admin permission value.
   */
  public function isIngressAdmin(): ?bool {
    return $this->ingressAdmin;
  }

  /**
   * Set the ingress admin permission.
   *
   * @param bool $ingressAdmin
   *   The ingress admin permission value.
   *
   * @return $this
   */
  public function setIngressAdmin(bool $ingressAdmin = TRUE): self {
    $this->ingressAdmin = $ingressAdmin;
    return $this;
  }

  /**
   * Check if the can publish permission is set.
   *
   * @return bool|null
   *   The can publish permission value.
   */
  public function isCanPublish(): ?bool {
    return $this->canPublish;
  }

  /**
   * Set the can publish permission.
   *
   * @param bool $canPublish
   *   The can publish permission value.
   *
   * @return $this
   */
  public function setCanPublish(bool $canPublish = TRUE): self {
    $this->canPublish = $canPublish;
    return $this;
  }

  /**
   * Check if the can subscribe permission is set.
   *
   * @return bool|null
   *   The can subscribe permission value.
   */
  public function isCanSubscribe(): ?bool {
    return $this->canSubscribe;
  }

  /**
   * Set the can subscribe permission.
   *
   * @param bool $canSubscribe
   *   The can subscribe permission value.
   *
   * @return $this
   */
  public function setCanSubscribe(bool $canSubscribe = TRUE): self {
    $this->canSubscribe = $canSubscribe;
    return $this;
  }

  /**
   * Check if the can publish data permission is set.
   *
   * @return bool|null
   *   The can publish data permission value.
   */
  public function isCanPublishData(): ?bool {
    return $this->canPublishData;
  }

  /**
   * Set the can publish data permission.
   *
   * @param bool $canPublishData
   *   The can publish data permission value.
   *
   * @return $this
   */
  public function setCanPublishData(bool $canPublishData = TRUE): self {
    $this->canPublishData = $canPublishData;
    return $this;
  }

  /**
   * Set the can publish sources.
   *
   * @param string[] $canPublishSources
   *   The can publish sources value.
   *
   * @return $this
   */
  public function setCanPublishSources(array $canPublishSources = []): self {
    $this->canPublishSources = $canPublishSources;
    return $this;
  }

  /**
   * Get the can publish sources.
   *
   * @return string[]|null
   *   The can publish sources value.
   */
  public function getCanPublishSources(): ?array {
    return $this->canPublishSources;
  }

  /**
   * Check if the can update own metadata permission is set.
   *
   * @return bool|null
   *   The can update own metadata permission value.
   */
  public function isCanUpdateOwnMetadata(): ?bool {
    return $this->canUpdateOwnMetadata;
  }

  /**
   * Set the can update own metadata permission.
   *
   * @param bool $canUpdateOwnMetadata
   *   The can update own metadata permission value.
   *
   * @return $this
   */
  public function setCanUpdateOwnMetadata(bool $canUpdateOwnMetadata = TRUE): self {
    $this->canUpdateOwnMetadata = $canUpdateOwnMetadata;
    return $this;
  }

  /**
   * Check if the hidden permission is set.
   *
   * @return bool|null
   *   The hidden permission value.
   */
  public function isHidden(): ?bool {
    return $this->hidden;
  }

  /**
   * Set the hidden permission.
   *
   * @param bool $hidden
   *   The hidden permission value.
   *
   * @return $this
   */
  public function setHidden(bool $hidden = TRUE): self {
    $this->hidden = $hidden;
    return $this;
  }

  /**
   * Check if the recorder permission is set.
   *
   * @return bool|null
   *   The recorder permission value.
   */
  public function isRecorder(): ?bool {
    return $this->recorder;
  }

  /**
   * Set the recorder permission.
   *
   * @param bool $recorder
   *   The recorder permission value.
   *
   * @return $this
   */
  public function setRecorder(bool $recorder = TRUE): self {
    $this->recorder = $recorder;
    return $this;
  }

  /**
   * Check if the participant can subscribe to metrics.
   *
   * @return bool|null
   *   The canSubscribeMetrics permission value.
   */
  public function isCanSubscribeMetrics(): ?bool {
    return $this->canSubscribeMetrics;
  }

  /**
   * Set the canSubscribeMetrics permission.
   *
   * @param bool|null $canSubscribeMetrics
   *   The can subscribe metrics permission value.
   *
   * @return $this
   */
  public function setCanSubscribeMetrics(?bool $canSubscribeMetrics = TRUE): self {
    $this->canSubscribeMetrics = $canSubscribeMetrics;
    return $this;
  }

  /**
   * Get the destination room.
   *
   * @return string|null
   *   The destination room name.
   */
  public function getDestinationRoom(): ?string {
    return $this->destinationRoom;
  }

  /**
   * Set the destination room.
   *
   * @param string|null $destinationRoom
   *   The destination room name.
   *
   * @return $this
   */
  public function setDestinationRoom(?string $destinationRoom): self {
    $this->destinationRoom = $destinationRoom;
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
