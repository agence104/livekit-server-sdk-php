<?php

namespace Agence104\LiveKit;

use Twirp\Context;
use Livekit\Room;
use Livekit\SendDataRequest;
use Livekit\ParticipantInfo;
use Livekit\SendDataResponse;
use Livekit\ListRoomsRequest;
use Livekit\CreateRoomRequest;
use Livekit\DeleteRoomRequest;
use Livekit\ListRoomsResponse;
use Livekit\DeleteRoomResponse;
use Livekit\MuteRoomTrackRequest;
use Livekit\ParticipantPermission;
use Livekit\MuteRoomTrackResponse;
use Livekit\RoomParticipantIdentity;
use Livekit\ListParticipantsRequest;
use Livekit\UpdateParticipantRequest;
use Livekit\ListParticipantsResponse;
use Livekit\UpdateRoomMetadataRequest;
use Livekit\RemoveParticipantResponse;
use Livekit\UpdateSubscriptionsRequest;
use Livekit\UpdateSubscriptionsResponse;

class RoomServiceClient extends BaseServiceClient {

  /**
   * The Twirp RPC adapter for client implementation.
   *
   * @var \Livekit\RoomServiceClient
   */
  protected $rpc;

  /**
   * {@inheritdoc}
   */
  public function __construct(?string $host = NULL, ?string $apiKey = NULL, ?string $apiSecret = NULL) {
    parent::__construct($host,$apiKey, $apiSecret);

    $this->rpc = new \Livekit\RoomServiceClient($this->host);
  }

  /**
   * Creates a new room. Explicit room creation is not required, since rooms
   * will be automatically created when the first participant joins. This method
   * can be used to customize room settings.
   *
   * @param \Agence104\LiveKit\RoomCreateOptions $createOptions
   *
   * @return \Livekit\Room
   *   The Room object.
   */
  public function createRoom(RoomCreateOptions $createOptions): Room {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();
    return $this->rpc->createRoom(
      $this->authHeader($videoGrant),
      new createRoomRequest($createOptions->getData())
    );
  }

  /**
   * List active rooms.
   *
   * @param array $roomNames
   *   The room names, when undefined or empty, list all rooms,
   *   otherwise returns rooms with matching names.
   *
   * @return \Livekit\ListRoomsResponse
   *   The ListRoomsResponse object.
   */
  public function listRooms(array $roomNames = []): ListRoomsResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomList();
    return $this->rpc->ListRooms(
      $this->authHeader($videoGrant),
      new ListRoomsRequest([
        'names' => $roomNames,
      ])
    );
  }

  /**
   * List active rooms.
   *
   * @param string $roomName
   *   The name of the room.
   *
   * @return \Livekit\DeleteRoomResponse
   *   The ListRoomsResponse object.
   */
  public function deleteRoom(string $roomName): DeleteRoomResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();
    return $this->rpc->DeleteRoom(
      $this->authHeader($videoGrant),
      new DeleteRoomRequest([
        'room' => $roomName,
      ])
    );
  }

  /**
   * Update the metadata of a room.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $metadata
   *   The new metadata for the room.
   *
   * @return \Livekit\Room
   *   The Room object.
   */
  public function updateRoomMetadata(string $roomName, string $metadata): Room {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->UpdateRoomMetadata(
      $this->authHeader($videoGrant),
      new UpdateRoomMetadataRequest([
        'room' => $roomName,
        'metadata' => $metadata,
      ])
    );
  }

  /**
   * List the participants in a room.
   *
   * @param string $roomName
   *   The name of the room.
   *
   * @return \Livekit\ListParticipantsResponse
   *   The ListParticipantsResponse object.
   */
  public function listParticipants(string $roomName): ListParticipantsResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->ListParticipants(
      $this->authHeader($videoGrant),
      new ListParticipantsRequest([
        'room' => $roomName,
      ])
    );
  }

  /**
   * Get information on a specific participant, including the tracks that the
   * participant has published.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $identity
   *   The identity of the participant.
   *
   * @return \Livekit\ParticipantInfo
   *   The ParticipantInfo object.
   */
  public function getParticipant(string $roomName, string $identity): ParticipantInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->GetParticipant(
      $this->authHeader($videoGrant),
      new RoomParticipantIdentity([
        'room' => $roomName,
        'identity' => $identity,
      ])
    );
  }

  /**
   * Removes a participant in the room. This will disconnect the participant
   * and will emit a Disconnected event for that participant. Even after being
   * removed, the participant can still re-join the room.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $identity
   *   The identity of the participant.
   *
   * @return \Livekit\RemoveParticipantResponse
   *   The RemoveParticipantResponse object.
   */
  public function removeParticipant(string $roomName, string $identity): RemoveParticipantResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->RemoveParticipant(
      $this->authHeader($videoGrant),
      new RoomParticipantIdentity([
        'room' => $roomName,
        'identity' => $identity,
      ])
    );
  }

  /**
   * Mutes a track that the participant has published.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $identity
   *   The identity of the participant.
   * @param string $trackSid
   *   The sid of the track to be muted.
   * @param bool $muted
   *   The flag which defines if the track needs to be muted or not.
   *   True to mute, false to unmute.
   *
   * @return \Livekit\MuteRoomTrackResponse
   *   The MuteRoomTrackResponse object.
   */
  public function mutePublishedTrack(string $roomName, string $identity, string $trackSid, bool $muted): MuteRoomTrackResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->MutePublishedTrack(
      $this->authHeader($videoGrant),
      new MuteRoomTrackRequest([
        'room' => $roomName,
        'identity' => $identity,
        'track_sid' => $trackSid,
        'muted' => $muted,
      ])
    );
  }

  /**
   * Updates a participant's metadata or permissions.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $identity
   *   The identity of the participant.
   * @param string|null $metadata
   *   Optional, the metadata to update.
   * @param ParticipantPermission|null $permission
   *   Optional, the new permissions to assign to the participant.
   *
   * @return \Livekit\ParticipantInfo
   *   The ParticipantInfo object.
   */
  public function updateParticipant(string $roomName, string $identity, string $metadata = NULL, ParticipantPermission $permission = NULL): ParticipantInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->UpdateParticipant(
      $this->authHeader($videoGrant),
      new UpdateParticipantRequest([
        'room' => $roomName,
        'identity' => $identity,
        'metadata' => $metadata ?? '',
        'permission' => $permission,
      ])
    );
  }

  /**
   * Updates a participant's subscription to tracks.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $identity
   *   The identity of the participant.
   * @param string[] $trackSids
   *   The sids of the tracks to subscribe.
   * @param bool $subscribe
   *   The flag which defines if the tracks needs to be subscribed or not.
   *   True to subscribe, false to unsubscribe.
   *
   * @return \Livekit\UpdateSubscriptionsResponse
   *   The UpdateSubscriptionsResponse object.
   */
  public function updateSubscriptions(string $roomName, string $identity, array $trackSids, bool $subscribe): UpdateSubscriptionsResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->UpdateSubscriptions(
      $this->authHeader($videoGrant),
      new UpdateSubscriptionsRequest([
        'room' => $roomName,
        'identity' => $identity,
        'track_sids' => $trackSids,
        'subscribe' => $subscribe,
      ])
    );
  }

  /**
   * Sends data message to participants in the room.
   *
   * @param string $roomName
   *   The name of the room.
   * @param string $data
   *   The payload to send.
   * @param int $kind
   *   The delivery reliability.
   * @param string[] $destinationSids
   *   Optional, when empty, message is sent to everyone.
   *
   * @return \Livekit\SendDataResponse
   *   The SendDataResponse object.
   */
  public function sendData(string $roomName, string $data, int $kind, array $destinationSids = []): SendDataResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName($roomName);
    $videoGrant->setRoomAdmin();
    return $this->rpc->SendData(
      $this->authHeader($videoGrant),
      new SendDataRequest([
        'room' => $roomName,
        'data' => $data,
        'kind' => $kind,
        'destination_sids' => $destinationSids,
      ])
    );
  }

}
