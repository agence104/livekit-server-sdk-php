<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\RoomCreateOptions;
use Agence104\LiveKit\RoomServiceClient;
use Exception;
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

class RoomServiceClientTest extends TestCase {
  /**
   * The room service client instance.
   */
  private RoomServiceClient $client;

  /**
   * The room name of the main room with participants.
   * This room is created prior to running the tests.
   */
  private string $mainRoom = 'testRoomParticipants';

  protected function setUp(): void {
    try {
      $this->client = new RoomServiceClient();
    }
    catch(Exception $e) {
      $this->fail('Failed to set up RoomServiceClient: ' . $e->getMessage());
    }
  }

  public static function tearDownAfterClass(): void {
    try {
      $client = new RoomServiceClient();

      // Rooms CleanUp.
      $client->deleteRoom('testCreateRoom');
      $client->deleteRoom('testListRoom');
      $client->deleteRoom('testDeleteRoom');
      $client->deleteRoom('testMetadataRoom');
      $client->deleteRoom('testListPartRoom');
    } catch(Exception $e) {
      // Ignore errors during cleanup.
    }

    parent::tearDownAfterClass();
  }

  private function createRoom(string $roomName): Room {
    $options = (new RoomCreateOptions())
      ->setName($roomName)
      ->setEmptyTimeout(10)
      ->setMaxParticipants(20);
    return $this->client->createRoom($options);
  }

  public function testCreateRoom(): void {
    $roomName = 'testCreateRoom';
    $response = $this->createRoom($roomName);

    $this->assertEquals($roomName, $response->getName());
  }

  public function testListRooms(): void {
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

  public function testDeleteRoom(): void {
    $roomName = 'testDeleteRoom';
    $room = $this->createRoom($roomName);
    $this->assertEquals($roomName, $room->getName());

    $response = $this->client->deleteRoom($roomName);
    $this->assertInstanceOf(DeleteRoomResponse::class, $response);

    $response = $this->client->listRooms([$roomName]);
    $this->assertEquals(0, $response->getRooms()->count());
  }

  public function testUpdateRoomMetadata(): void {
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

  public function testListParticipants(): void {
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

  public function testGetParticipant(): void {
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[0];
    $identity = $participant->getIdentity();

    $response = $this->client->getParticipant($this->mainRoom, $identity);
    $this->assertInstanceOf(ParticipantInfo::class, $response);
    $this->assertEquals($identity, $response->getIdentity());
  }

  public function testRemoveParticipant(): void {
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[1];
    $identity = $participant->getIdentity();

    $response = $this->client->removeParticipant($this->mainRoom, $identity);
    $this->assertInstanceOf(RemoveParticipantResponse::class, $response);

    $error = "";
    try {
      $this->client->getParticipant($this->mainRoom, $identity);
    }
    catch(Exception $e) {
      $error = $e->getMessage();
    }
    $this->assertEquals("participant does not exist", $error);
  }

  public function testMutePublishedTrack(): void {
    $response = $this->client->listParticipants($this->mainRoom);
    $track = null;
    $identity = null;

    foreach ($response->getParticipants() as $participant) {
      if ($participant->getIsPublisher()) {
        foreach ($participant->getTracks() as $track) {
          if (! $track->getMuted()) {
            $participant = $participant;
            $identity = $participant->getIdentity();
            $track = $participant->getTracks()[0];
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

  public function testUpdateParticipant(): void {
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
    $permission->setCanPublishData(false);
    $permission->setCanSubscribe(false);
    $permission->setCanUpdateMetadata(true);
    $participant = $this->client->updateParticipant($this->mainRoom, $identity, $metadata, $permission);
    $perm = $participant->getPermission();

    $this->assertInstanceOf(ParticipantInfo::class, $participant);
    $this->assertEquals($metadata, $participant->getMetadata());
    $this->assertFalse($perm->getCanPublishData());
    $this->assertFalse($perm->getCanSubscribe());
    $this->assertTrue($perm->getCanUpdateMetadata());
  }

  public function testUpdateSubscriptions(): void {
    $response = $this->client->listParticipants($this->mainRoom);
    $publisherTrack = null;
    $participant = null;
    foreach ($response->getParticipants() as $participant) {
      if ($participant->getIsPublisher() && !$publisherTrack) {
        foreach ($participant->getTracks() as $track) {
          if (!$track->getMuted()) {
            $participant = $participant;
            $identity = $participant->getIdentity();
            $publisherTrack = $participant->getTracks()[0];
            break;
          }
        }
        break;
      }
      elseif (!$participant->getIsPublisher() && !$participant) {
        $participant = $participant;
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

  public function testSendData(): void {
    $data = 'sampleData';
    $response = $this->client->sendData($this->mainRoom, $data, Kind::RELIABLE, []);
    $this->assertInstanceOf(SendDataResponse::class, $response);
  }

}
