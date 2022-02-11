<?php

namespace Agence104\LiveKit;

class VideoGrant {

  /**
   * Permission to create a room.
   *
   * @var bool
   */
  public $roomCreate;

  /**
   * Permission to join a room as a participant, room must be set.
   *
   * @var bool
   */
  public $roomJoin;

  /**
   * Permission to list rooms.
   *
   * @var bool
   */
  public $roomList;

  /**
   * Permission to start a recording.
   *
   * @var bool
   */
  public $roomRecord;

  /**
   * Permission to control a specific room, room must be set.
   *
   * @var bool
   */
  public $roomAdmin;

  /**
   * Name of the room, must be set for admin or join permissions.
   *
   * @var string
   */
  public $room;

  /**
   * Allow participant to publish. If neither canPublish or canSubscribe is set,
   * both publish and subscribe are enabled
   *
   * @var bool
   */
  public $canPublish;

  /**
   * Allow participant to subscribe to other tracks.
   *
   * @var bool
   */
  public $canSubscribe;

  /**
   * Allow participants to publish data, defaults to true if not set
   *
   * @var bool
   */
  public $canPublishData;

  /**
   * Participant isn't visible to others.
   *
   * @var bool
   */
  public $hidden;

  /**
   * Participant is recording the room, when set, allows room to indicate it's being recorded
   *
   * @var bool
   */
  public $recorder;

}
