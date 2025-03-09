<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\RoomCreateOptions;
use Agence104\LiveKit\RoomServiceClient;
use Livekit\DataPacket\Kind;
use Livekit\DeleteRoomResponse;
use Livekit\ListParticipantsResponse;
use Livekit\MuteRoomTrackResponse;
use Livekit\ParticipantInfo;
use Livekit\ParticipantPermission;
use Livekit\RemoveParticipantResponse;
use Livekit\Room;
use Livekit\SendDataResponse;
use Livekit\UpdateSubscriptionsResponse;
use PHPUnit\Framework\TestCase;

/**
 * Tests the RoomServiceClient class.
 */
class RoomServiceClientTest extends TestCase {
  /**
   * The room service client instance.
   *
   * @var \Livekit\RoomServiceClient
   */
  private $client;

  /**
   * Main room name with participants, created before test execution.
   *
   * @var string
   */
  private $mainRoom = 'testRoomParticipants';

  /**
   * Sets up the test environment.
   */
  protected function setUp(): void {
    try {
      $this->client = new RoomServiceClient();
    }
    catch (\Exception $e) {
      $this->fail('Failed to set up RoomServiceClient: ' . $e->getMessage());
    }
  }

  /**
   * Tears down the test environment.
   */
  public static function tearDownAfterClass(): void {
    try {
      $client = new RoomServiceClient();

      // Rooms CleanUp.
      $roomName = 'testCreateRoom';
      $client->deleteRoom($roomName);
      $roomName = 'testListRoom';
      $client->deleteRoom($roomName);
      $roomName = 'testDeleteRoom';
      $client->deleteRoom($roomName);
      $roomName = 'testMetadataRoom';
      $client->deleteRoom($roomName);
      $roomName = 'testListPartRoom';
      $client->deleteRoom($roomName);
    }
    catch (\Exception $e) {
    }
    parent::tearDownAfterClass();
  }

  /**
   * Creates a room.
   *
   * @param string $roomName
   *   The name of the room to create.
   *
   * @return \Livekit\Room
   *   The created room.
   */
  private function createRoom($roomName): Room {
    $opts = (new RoomCreateOptions())
      ->setName($roomName)
      ->setEmptyTimeout(10)
      ->setMaxParticipants(20);
    return $this->client->createRoom($opts);
  }

  /**
   * Tests creating a room.
   */
  public function testCreateRoom() {
    $roomName = 'testCreateRoom';
    $response = $this->createRoom($roomName);

    $this->assertEquals($roomName, $response->getName());
  }

  /**
   * Tests listing rooms.
   */
  public function testListRooms() {
    // Let's create another room.
    $roomName = 'testListRoom';
    $this->createRoom($roomName);

    // Let's wait for 5 seconds here.
    sleep(5);

    $response = $this->client->listRooms();
    $this->assertGreaterThanOrEqual(2, $response->getRooms()->count());

    $response = $this->client->listRooms([$roomName]);
    $this->assertEquals(1, $response->getRooms()->count());
  }

  /**
   * Tests deleting a room.
   */
  public function testDeleteRoom() {
    $roomName = 'testDeleteRoom';
    $room = $this->createRoom($roomName);
    $this->assertEquals($roomName, $room->getName());

    $response = $this->client->deleteRoom($roomName);
    $this->assertInstanceOf(DeleteRoomResponse::class, $response);

    $response = $this->client->listRooms([$roomName]);
    $this->assertEquals(0, $response->getRooms()->count());
  }

  /**
   * Tests updating a room's metadata.
   */
  public function testUpdateRoomMetadata() {
    $roomName = 'testMetadataRoom';
    $this->createRoom($roomName);

    $metadata = '{"testKey": "testValue"}';
    $response = $this->client->listRooms([$roomName]);
    $rooms = $response->getRooms();
    if ($rooms->count() < 1) {
      $this->fail("Could not find $roomName.");
    }
    $room = $rooms[0];
    $this->assertEquals('', $room->getMetadata());

    $room = $this->client->updateRoomMetadata($roomName, $metadata);
    $this->assertInstanceOf(Room::class, $room);
    $this->assertEquals($metadata, $room->getMetadata());

    // Clean up.
    $this->client->deleteRoom($roomName);
  }

  /**
   * Tests listing participants.
   */
  public function testListParticipants() {
    $roomName = 'testListPartRoom';
    $this->createRoom($roomName);

    $response = $this->client->listParticipants($roomName);
    $this->assertInstanceOf(ListParticipantsResponse::class, $response);
    $this->assertEquals(0, $response->getParticipants()->count());

    $response = $this->client->listParticipants($this->mainRoom);
    $this->assertGreaterThanOrEqual(5, $response->getParticipants()->count());

    // Clean up.
    $this->client->deleteRoom($roomName);
  }

  /**
   * Tests getting a participant.
   */
  public function testGetParticipant() {
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[0];
    $identity = $participant->getIdentity();

    $response = $this->client->getParticipant($this->mainRoom, $identity);
    $this->assertInstanceOf(ParticipantInfo::class, $response);
    $this->assertEquals($identity, $response->getIdentity());
  }

  /**
   * Tests removing a participant.
   */
  public function testRemoveParticipant() {
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[1];
    $identity = $participant->getIdentity();

    $response = $this->client->removeParticipant($this->mainRoom, $identity);
    $this->assertInstanceOf(RemoveParticipantResponse::class, $response);

    $error = "";
    try {
      $this->client->getParticipant($this->mainRoom, $identity);
    }
    catch (\Exception $e) {
      $error = $e->getMessage();
    }
    $this->assertEquals("participant does not exist", $error);
  }

  /**
   * Tests muting a published track.
   */
  public function testMutePublishedTrack() {
    $response = $this->client->listParticipants($this->mainRoom);
    $track = NULL;
    $identity = NULL;

    foreach ($response->getParticipants() as $p) {
      if ($p->getIsPublisher()) {
        foreach ($p->getTracks() as $t) {
          if (!$t->getMuted()) {
            $participant = $p;
            $identity = $participant->getIdentity();
            $track = $p->getTracks()[0];
            break 2;
          }
        }
        break;
      }
    }

    if (!$track) {
      $this->fail("Unable to test. No published track found!");
      return;
    }

    $sid = $track->getSid();
    $this->assertFalse($track->getMuted());

    $response = $this->client->mutePublishedTrack($this->mainRoom, $identity, $sid, TRUE);
    $this->assertInstanceOf(MuteRoomTrackResponse::class, $response);
    $this->assertTrue($response->getTrack()->getMuted());

    $response = $this->client->mutePublishedTrack($this->mainRoom, $identity, $sid, FALSE);
    $this->assertFalse($response->getTrack()->getMuted());
  }

  /**
   * Tests updating a participant.
   */
  public function testUpdateParticipant() {
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[2];
    $identity = $participant->getIdentity();
    $perm = $participant->getPermission();

    $this->assertEquals("", $participant->getMetadata());
    $this->assertTrue($perm->getCanPublishData());
    $this->assertTrue($perm->getCanSubscribe());
    $this->assertFalse($perm->getCanUpdateMetadata());

    $metadata = '{value: test}';
    $permission = new ParticipantPermission();
    $permission->setCanPublishData(FALSE);
    $permission->setCanSubscribe(FALSE);
    $permission->setCanUpdateMetadata(TRUE);
    $participant = $this->client->updateParticipant($this->mainRoom, $identity, $metadata, $permission);
    $perm = $participant->getPermission();

    $this->assertInstanceOf(ParticipantInfo::class, $participant);
    $this->assertEquals($metadata, $participant->getMetadata());
    $this->assertFalse($perm->getCanPublishData());
    $this->assertFalse($perm->getCanSubscribe());
    $this->assertTrue($perm->getCanUpdateMetadata());
  }

  /**
   * Tests updating subscriptions.
   */
  public function testUpdateSubscriptions() {
    $response = $this->client->listParticipants($this->mainRoom);
    $publisherTrack = NULL;
    $participant = NULL;
    foreach ($response->getParticipants() as $p) {
      if ($p->getIsPublisher() && !$publisherTrack) {
        foreach ($p->getTracks() as $t) {
          if (!$t->getMuted()) {
            $participant = $p;
            $identity = $participant->getIdentity();
            $publisherTrack = $p->getTracks()[0];
            break;
          }
        }
        break;
      }
      elseif (!$p->getIsPublisher() && !$participant) {
        $participant = $p;
      }

      if ($publisherTrack && $participant) {
        break;
      }
    }

    if (!$publisherTrack || !$participant) {
      $this->fail('Missing Publisher Track or participant');
    }

    $response = $this->client->updateSubscriptions(
      $this->mainRoom,
      $participant->getIdentity(),
      [$publisherTrack->getSid()],
      FALSE
    );
    $this->assertInstanceOf(UpdateSubscriptionsResponse::class, $response);
  }

  /**
   * Tests sending data.
   */
  public function testSendData() {
    $data = 'sampleData';
    $response = $this->client->sendData($this->mainRoom, $data, Kind::RELIABLE, []);
    $this->assertInstanceOf(SendDataResponse::class, $response);
  }

}
