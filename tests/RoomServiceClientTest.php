<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\RoomAgentDispatch;
use Agence104\LiveKit\RoomConfiguration;
use Agence104\LiveKit\RoomCreateOptions;
use Agence104\LiveKit\RoomServiceClient;
use Livekit\DataPacket\Kind;
use Livekit\DeleteRoomResponse;
use Livekit\ForwardParticipantResponse;
use Livekit\ListParticipantsResponse;
use Livekit\MoveParticipantResponse;
use Livekit\MuteRoomTrackResponse;
use Livekit\ParticipantInfo;
use Livekit\ParticipantPermission;
use Livekit\RemoveParticipantResponse;
use Livekit\Room;
use Livekit\RoomEgress;
use Livekit\SendDataResponse;
use Livekit\UpdateSubscriptionsResponse;
use PHPUnit\Framework\TestCase;

/**
 * Tests the RoomServiceClient class.
 */
class RoomServiceClientTest extends TestCase {
  /**
   * The room service client instance.
   */
  private RoomServiceClient $client;

  /**
   * Main room name with participants, created before test execution.
   */
  private string $mainRoom = 'testRoomParticipants';

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
   * Tests Room Create Options.
   */
  public function testRoomCreateOptions() {

    // Empty name test.
    $opts = (new RoomCreateOptions())->setEmptyTimeout(10);
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('The name of the room is required.');
    $opts->getData();

    // Create a room with snake_case keys.
    $opts = (new RoomCreateOptions([
      'name' => 'my-room',
      'empty_timeout' => 10,
      'max_participants' => 20,
    ]));

    $this->assertEquals([
      'empty_timeout' => 10,
      'max_participants' => 20,
    ], $opts->getData());

    $opts->setName('my-room');

    $this->assertEquals([
      'name' => 'my-room',
      'empty_timeout' => 10,
      'max_participants' => 20,
    ], $opts->getData());

    // Create a room with camelCase keys.
    $opts = (new RoomCreateOptions([
      'emptyTimeout' => 10,
      'maxParticipants' => 20,
      'name' => 'my-room',
    ]));

    $this->assertEquals([
      'empty_timeout' => 10,
      'max_participants' => 20,
      'name' => 'my-room',
    ], $opts->getData());

    // Create a room egress.
    $egress = new RoomEgress();

    // Test all methods.
    $opts = (new RoomCreateOptions())
      ->setName('my-room')
      ->setEmptyTimeout(10)
      ->setMaxParticipants(20)
      ->setNodeId('my-node')
      ->setMetadata('my-metadata')
      ->setEgress($egress)
      ->setMinPlayoutDelay(10)
      ->setMaxPlayoutDelay(20)
      ->setSyncStreams(TRUE)
      ->setRoomPreset('preset-name')
      ->setDepartureTimeout(30)
      ->setReplayEnabled(TRUE);

    $this->assertEquals('my-room', $opts->getName());
    $this->assertEquals(10, $opts->getEmptyTimeout());
    $this->assertEquals(20, $opts->getMaxParticipants());
    $this->assertEquals('my-node', $opts->getNodeId());
    $this->assertEquals('my-metadata', $opts->getMetadata());
    $this->assertEquals($egress, $opts->getEgress());
    $this->assertEquals(10, $opts->getMinPlayoutDelay());
    $this->assertEquals(20, $opts->getMaxPlayoutDelay());
    $this->assertTrue($opts->getSyncStreams());
    $this->assertEquals('preset-name', $opts->getRoomPreset());
    $this->assertEquals(30, $opts->getDepartureTimeout());
    $this->assertTrue($opts->getReplayEnabled());

    $this->assertEquals([
      'empty_timeout' => 10,
      'max_participants' => 20,
      'name' => 'my-room',
      'node_id' => 'my-node',
      'metadata' => 'my-metadata',
      'egress' => $egress,
      'min_playout_delay' => 10,
      'max_playout_delay' => 20,
      'sync_streams' => TRUE,
      'room_preset' => 'preset-name',
      'departure_timeout' => 30,
      'replay_enabled' => TRUE,
    ], $opts->getData());

    // Test with agent dispatch configuration
    $agent1 = (new RoomAgentDispatch())
      ->setAgentName('transcription-agent')
      ->setMetadata('transcription metadata');
    
    $agent2 = (new RoomAgentDispatch())
      ->setAgentName('moderation-agent');

    $roomConfig = (new RoomConfiguration())
      ->setName('agent-room')
      ->setEmptyTimeout(300)
      ->setMaxParticipants(20)
      ->setAgents([$agent1, $agent2]);

    $this->assertEquals('agent-room', $roomConfig->getName());
    $this->assertCount(2, $roomConfig->getAgents());
    
    $configData = $roomConfig->getData();
    $this->assertArrayHasKey('agents', $configData);
    $this->assertCount(2, $configData['agents']);
    $this->assertEquals('transcription-agent', $configData['agents'][0]['agent_name']);
    $this->assertEquals('transcription metadata', $configData['agents'][0]['metadata']);
    $this->assertEquals('moderation-agent', $configData['agents'][1]['agent_name']);

    // Test roomPreset
    $opts = (new RoomCreateOptions())
      ->setName('preset-room')
      ->setRoomPreset('my-preset');
    $this->assertEquals('my-preset', $opts->getRoomPreset());
    $data = $opts->getData();
    $this->assertArrayHasKey('room_preset', $data);
    $this->assertEquals('my-preset', $data['room_preset']);

    // Test departureTimeout
    $opts = (new RoomCreateOptions())
      ->setName('departure-room')
      ->setDepartureTimeout(60);
    $this->assertEquals(60, $opts->getDepartureTimeout());
    $data = $opts->getData();
    $this->assertArrayHasKey('departure_timeout', $data);
    $this->assertEquals(60, $data['departure_timeout']);

    // Test replayEnabled
    $opts = (new RoomCreateOptions())
      ->setName('replay-room')
      ->setReplayEnabled(TRUE);
    $this->assertTrue($opts->getReplayEnabled());
    $data = $opts->getData();
    $this->assertArrayHasKey('replay_enabled', $data);
    $this->assertTrue($data['replay_enabled']);

    $opts->setReplayEnabled(FALSE);
    $this->assertFalse($opts->getReplayEnabled());
    $data = $opts->getData();
    $this->assertFalse($data['replay_enabled']);

    // Test agents array
    $agent1 = (new RoomAgentDispatch())
      ->setAgentName('agent-1')
      ->setMetadata('metadata-1');
    $agent2 = (new RoomAgentDispatch())
      ->setAgentName('agent-2');

    $opts = (new RoomCreateOptions())
      ->setName('agents-room')
      ->setAgents([$agent1, $agent2]);
    
    $this->assertCount(2, $opts->getAgents());
    $this->assertEquals('agent-1', $opts->getAgents()[0]->getAgentName());
    $this->assertEquals('metadata-1', $opts->getAgents()[0]->getMetadata());
    $this->assertEquals('agent-2', $opts->getAgents()[1]->getAgentName());

    $data = $opts->getData();
    $this->assertArrayHasKey('agents', $data);
    $this->assertCount(2, $data['agents']);
    $this->assertIsArray($data['agents'][0]);
    $this->assertEquals('agent-1', $data['agents'][0]['agent_name']);
    $this->assertEquals('metadata-1', $data['agents'][0]['metadata']);
    $this->assertEquals('agent-2', $data['agents'][1]['agent_name']);

    // Test with snake_case keys in constructor
    $opts = (new RoomCreateOptions([
      'name' => 'snake-room',
      'room_preset' => 'preset-snake',
      'departure_timeout' => 45,
      'replay_enabled' => TRUE,
    ]));
    $this->assertEquals('preset-snake', $opts->getRoomPreset());
    $this->assertEquals(45, $opts->getDepartureTimeout());
    $this->assertTrue($opts->getReplayEnabled());

    // Test with camelCase keys in constructor
    $opts = (new RoomCreateOptions([
      'name' => 'camel-room',
      'roomPreset' => 'preset-camel',
      'departureTimeout' => 90,
      'replayEnabled' => FALSE,
    ]));
    $this->assertEquals('preset-camel', $opts->getRoomPreset());
    $this->assertEquals(90, $opts->getDepartureTimeout());
    $this->assertFalse($opts->getReplayEnabled());
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
   * Tests forwarding a participant.
   */
  public function testForwardParticipant() {
    $roomName = 'testForwardRoom';
    $this->createRoom($roomName);

    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[0];
    $identity = $participant->getIdentity();

    $response = $this->client->forwardParticipant($this->mainRoom, $identity, $roomName);
    $this->assertInstanceOf(ForwardParticipantResponse::class, $response);

    $response = $this->client->listParticipants($roomName);
    $this->assertEquals(1, $response->getParticipants()->count());
    $this->assertEquals($identity, $response->getParticipants()[0]->getIdentity());

    // Clean up.
    $this->client->deleteRoom($roomName);
  }

  /**
   * Tests moving a participant.
   */
  public function testMoveParticipant() {
    $roomName = 'testMoveRoom';
    $this->createRoom($roomName);

    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[0];
    $identity = $participant->getIdentity();

    $response = $this->client->moveParticipant($this->mainRoom, $identity, $roomName);
    $this->assertInstanceOf(MoveParticipantResponse::class, $response);

    $response = $this->client->listParticipants($roomName);
    $this->assertEquals(1, $response->getParticipants()->count());
    $this->assertEquals($identity, $response->getParticipants()[0]->getIdentity());

    // Clean up.
    $this->client->deleteRoom($roomName);
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

    $name = 'new-name';
    $attributes = [
      'attribute1-key' => 'attribute1-value',
      'attribute2-key' => 'attribute2-value',
    ];

    $participant = $this->client->updateParticipant($this->mainRoom, $identity, $metadata, $permission, $name, $attributes);
    $perm = $participant->getPermission();

    $this->assertInstanceOf(ParticipantInfo::class, $participant);
    $this->assertEquals($metadata, $participant->getMetadata());
    $this->assertFalse($perm->getCanPublishData());
    $this->assertFalse($perm->getCanSubscribe());
    $this->assertTrue($perm->getCanUpdateMetadata());
    $this->assertEquals($name, $participant->getName());
    $this->assertEquals($attributes, iterator_to_array($participant->getAttributes()));

    $name = 'new-name-2';
    $participant = $this->client->updateParticipant($this->mainRoom, $identity, NULL, NULL, $name);
    $this->assertEquals($name, $participant->getName());
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

    // Send data to a specific topic.
    $response = $this->client->sendData($this->mainRoom, $data, Kind::RELIABLE, [], 'testTopic');
    $this->assertInstanceOf(SendDataResponse::class, $response);

    // Send data to a specific participant.
    $response = $this->client->listParticipants($this->mainRoom);
    $participant = $response->getParticipants()[0];
    $response = $this->client->sendData($this->mainRoom, $data, Kind::RELIABLE, [$participant->getIdentity()]);
    $this->assertInstanceOf(SendDataResponse::class, $response);
  }

}
