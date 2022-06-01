<?php

namespace Agence104\LiveKit;

use Livekit\CreateRoomRequest;
use Livekit\DeleteRoomRequest;
use Livekit\ListRoomsRequest;
use Livekit\ListRoomsResponse;
use Livekit\DeleteRoomResponse;
use Livekit\Room;
use Twirp\Context;

class RoomServiceClient {

  /**
   * The Twirp RPC adapter for client implementation.
   *
   * @var \Livekit\RoomServiceClient
   */
  protected $rpc;

  /**
   * The API Key, can be set in env var LIVEKIT_API_KEY.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * The API Secret, can be set in env var LIVEKIT_API_SECRET.
   *
   * @var string
   */
  protected $apiSecret;

  /**
   * RoomServiceClient Class Constructor.
   *
   * @param string $host
   *   The hostname including protocol. i.e. 'https://cluster.livekit.io'.   *
   * @param string|null $apiKey
   *   The API Key, can be set in env var LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The API Secret, can be set in env var LIVEKIT_API_SECRET.
   */
  public function __construct(string $host, string $apiKey = NULL, string $apiSecret = NULL) {
    $this->rpc = new \Livekit\RoomServiceClient($host);
    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
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
   * @param array $names
   *   The room names, when undefined or empty, list all rooms,
   *   otherwise returns rooms with matching names
   *
   * @return \Livekit\ListRoomsResponse
   *   The ListRoomsResponse object.
   */
  public function listRooms(array $names = []): ListRoomsResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomList();
    return $this->rpc->ListRooms(
      $this->authHeader($videoGrant),
      new ListRoomsRequest([
        'name' => $names,
      ])
    );
  }

  /**
   * List active rooms.
   *
   * @param string $name
   *   The room name to delete.
   *
   * @return \Livekit\DeleteRoomResponse
   *   The ListRoomsResponse object.
   */
  public function deleteRoom(string $name): DeleteRoomResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();
    return $this->rpc->DeleteRoom(
      $this->authHeader($videoGrant),
      new DeleteRoomRequest([
        'name' => $name,
      ])
    );
  }

  /**
   * Fetches the authorization header to be passed in the request.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *   The grants to apply on the AccessToken.
   *
   * @return array
   *   If everything worked, then the header values are returned,
   *   else an empty array is returned.
   */
  private function authHeader(VideoGrant $videoGrant): array {
    $tokenOptions = new AccessTokenOptions();
    $tokenOptions->setTtl(10 * 60); // 10 minutes.

    try {
      $accessToken = new AccessToken($tokenOptions, $this->apiKey, $this->apiSecret);
      $accessToken->setGrant($videoGrant);
      return Context::withHttpRequestHeaders([], [
        "Authorization" => "Bearer " . $accessToken->getToken(),
      ]);
    }
    catch (\Exception $e) {
      return [];
    }
  }

}
