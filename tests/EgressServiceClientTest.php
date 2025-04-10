<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\EgressServiceClient;
use Agence104\LiveKit\RoomServiceClient;
use Exception;
use Livekit\EgressInfo;
use Livekit\ListEgressResponse;
use Livekit\StreamInfo\Status;
use Livekit\StreamOutput;
use Livekit\StreamProtocol;
use Livekit\TrackType;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class EgressServiceClientTest extends TestCase {

  /**
   * The egress service client instance.
   */
  private EgressServiceClient $client;

  /**
   * The room name of the main room with participants.
   * This room is created prior to running the tests.
   */
  private string $mainRoom = 'testRoomParticipants';

  /**
   * The RTMP url to use to test StreamOutput.
   */
  private string $rtmpUrl;

  /**
   * The RTMP url2 to use to test StreamOutput.
   */
  private string $rtmpUrl2;

  protected function setUp(): void {
    $this->rtmpUrl = getenv('LIVEKIT_EGRESS_RTMP_URL')
      ?: "rtmp://youtube-url/stream";
    $this->rtmpUrl2 = getenv('LIVEKIT_EGRESS_RTMP_URL2')
      ?: "rtmp://twitch-url/path";

    try {
      $this->client = new EgressServiceClient();
    }
    catch(Exception $e) {
      $this->fail('Failed to set up EgressServiceClient: ' . $e->getMessage());
    }
  }

  public static function tearDownAfterClass(): void {
    try {
      $client = new EgressServiceClient();
      // Stop all egress instances.
      $response = $client->listEgress('','', TRUE);
      foreach($response->getItems() as $egress) {
        try {
          $client->stopEgress($egress->getEgressId());
        } catch (Exception $e) {}
      }
    }
    catch(Exception $e) {}
    parent::tearDownAfterClass();
  }

  public function testStartRoomCompositeEgress(): string {
    $output = new StreamOutput([
      'protocol' => StreamProtocol::RTMP,
      'urls' => [$this->rtmpUrl]
    ]);

    $response = $this->client->startRoomCompositeEgress(
      $this->mainRoom,
      'grid',
      $output
    );

    $this->assertInstanceOf(EgressInfo::class, $response);
    $egressId = $response->getEgressId();
    $this->assertNotEmpty($egressId);
    $this->assertEquals($this->mainRoom, $response->getRoomName());

    // Let's sleep for 10 seconds to allow the RTMP connection.
    sleep(10);

    return $response->getEgressId();
  }

  #[Depends('testStartRoomCompositeEgress')]
  public function testUpdateLayoutEgress(string $egressId): void {
    $response = $this->client->updateLayout($egressId, 'speaker');
    $this->assertInstanceOf(EgressInfo::class, $response);

    $this->assertEquals(1, $response->getStatus());
    $this->assertEquals($this->mainRoom, $response->getRoomName());
    $this->assertEquals($egressId, $response->getEgressId());

    // Let's sleep for 10 seconds to allow the RTMP stream to update.
    sleep(10);
  }

  #[Depends('testStartRoomCompositeEgress')]
  public function testUpdateStream(string $egressId): void {
    // Let's add the second url.
    $response = $this->client->updateStream($egressId, [$this->rtmpUrl2]);
    $this->assertInstanceOf(EgressInfo::class, $response);
    // Let's sleep for 10 seconds to allow the RTMP stream to update.
    sleep(10);

    $this->assertEquals("", $response->getError());
    $this->assertTrue($response->hasStream());
    $this->assertEquals(2, $response->getStreamResults()->count());
    // Let's sleep for 10 seconds to allow the RTMP stream to update.
    sleep(10);

    // Let's remove the URL.
    $response = $this->client->updateStream($egressId, [], [$this->rtmpUrl]);
    $this->assertInstanceOf(EgressInfo::class, $response);

    $this->assertEquals("", $response->getError());
    $this->assertEquals(2, $response->getStreamResults()->count());
    $items = $response->getStreamResults();
    $this->assertEquals(Status::FINISHED, $items[0]->getStatus());
    $this->assertEquals(Status::ACTIVE, $items[1]->getStatus());

    // Let's re-add the stream URL & remove our test URL.
    $response = $this->client->updateStream($egressId, [$this->rtmpUrl], [$this->rtmpUrl2]);

    $this->assertInstanceOf(EgressInfo::class, $response);
    $this->assertEquals("", $response->getError());
    $this->assertEquals(3, $response->getStreamResults()->count());

    $items = $response->getStreamResults();
    $this->assertEquals(Status::FINISHED, $items[0]->getStatus());
    $this->assertEquals(Status::FINISHED, $items[1]->getStatus());
    $this->assertEquals(Status::ACTIVE, $items[2]->getStatus());

    // Let's sleep for 5 seconds to allow the RTMP stream to update.
    sleep(5);
  }

  #[Depends('testStartRoomCompositeEgress')]
  public function testListEgress(string $egressId): void {
    $response = $this->client->listEgress($this->mainRoom);
    $this->assertInstanceOf(ListEgressResponse::class, $response);
    $this->assertGreaterThanOrEqual(1, $response->getItems()->count());
    // Let's sleep for 10 seconds to allow the RTMP stream to update.
    sleep(10);

    $response = $this->client->listEgress('', $egressId);
    $this->assertInstanceOf(ListEgressResponse::class, $response);
    $this->assertEquals(1, $response->getItems()->count());
    // Let's sleep for 10 seconds to allow the RTMP stream to update.
    sleep(10);

    $response = $this->client->listEgress('', '', TRUE);
    $this->assertInstanceOf(ListEgressResponse::class, $response);
    $this->assertEquals(1, $response->getItems()->count());

    $response = $this->client->listEgress();
    $this->assertInstanceOf(ListEgressResponse::class, $response);
    $this->assertGreaterThanOrEqual(1, $response->getItems()->count());
  }

  #[Depends('testStartRoomCompositeEgress')]
  public function testStopEgress(string $egressId): void {
    try {
      $response = $this->client->stopEgress($egressId);
      $this->assertInstanceOf(EgressInfo::class, $response);
    }
    catch(Exception $e) {
      $this->fail('Error deleting Ingress: ' . $e->getMessage());
    }

    // Let's wait for 10 seconds here.
    sleep(10);
  }

  public function testStartWebEgress(): void {
    $output = new StreamOutput([
      'protocol' => StreamProtocol::RTMP,
      'urls' => [$this->rtmpUrl]
    ]);

    $response = $this->client->startWebEgress(
      'https://docs.livekit.io/server/egress',
      $output
    );

    $this->assertInstanceOf(EgressInfo::class, $response);
    $egressId = $response->getEgressId();
    $this->assertNotEmpty($egressId);
    $this->assertEquals("stream", $response->getResult());

    // Let's sleep for 15 seconds to allow the RTMP connection.
    sleep(15);

    $this->client->stopEgress($egressId);
  }

  public function testStartTrackCompositeEgress(): void {
    try {
      $roomClient = new RoomServiceClient();
    }
    catch(Exception $e) {
      $this->fail('Failed to set up RoomServiceClient: ' . $e->getMessage());
    }
    $videoTrackId = null;
    $audioTrackId = null;
    $response = $roomClient->listParticipants($this->mainRoom);
    foreach ($response->getParticipants() as $p) {
      if ($p->getIsPublisher()) {
        foreach ($p->getTracks() as $t) {
          if (!$t->getMuted() && !$videoTrackId && $t->getType() === TrackType::VIDEO) {
            $videoTrackId = $t->getSid();
          }
          else if (!$t->getMuted() && !$audioTrackId && $t->getType() === TrackType::AUDIO) {
            $audioTrackId = $t->getSid();
          }

          if ($videoTrackId && $audioTrackId) {
            break 2;
          }
        }
      }
    }

    if (!$videoTrackId) {
      $this->fail('Video Track not found!');
    }
    elseif (!$audioTrackId) {
      $this->fail('Audio track not found!');
    }

    $output = new StreamOutput([
      'protocol' => StreamProtocol::RTMP,
      'urls' => [$this->rtmpUrl]
    ]);

    $response = $this->client->startTrackCompositeEgress(
      $this->mainRoom,
      $output,
      $audioTrackId,
      $videoTrackId
    );

    $this->assertInstanceOf(EgressInfo::class, $response);
    $egressId = $response->getEgressId();
    $this->assertNotEmpty($egressId);
    $this->assertEquals($this->mainRoom, $response->getRoomName());
    $this->assertEmpty($response->getError());

    // Lets Sleep for 5 seconds.
    sleep(5);

    // Let's stop the egress and wait 10 seconds.
    $this->client->stopEgress($egressId);
    sleep(10);
  }

  public function testStartTrackEgress(): string {
    try {
      $roomClient = new RoomServiceClient();
    }
    catch(Exception $e) {
      $this->fail('Failed to set up RoomServiceClient: ' . $e->getMessage());
    }
    $trackId = null;
    $response = $roomClient->listParticipants($this->mainRoom);
    foreach ($response->getParticipants() as $p) {
      if ($p->getIsPublisher()) {
        foreach ($p->getTracks() as $t) {
          if (!$t->getMuted()) {
            $trackId = $t->getSid();
            break 2;
          }
        }
      }
    }

    if (!$trackId) {
      $this->fail('Track not found!');
    }

    $response = $this->client->startTrackEgress(
      $this->mainRoom,
      'wss://ws.postman-echo.com/socketio',
      $trackId
    );

    $this->assertInstanceOf(EgressInfo::class, $response);
    $egressId = $response->getEgressId();
    $this->assertNotEmpty($egressId);
    $this->assertEquals($this->mainRoom, $response->getRoomName());
    $this->assertEmpty($response->getError());

    // Let's sleep for 20 seconds to allow the RTMP stream to update.
    sleep(20);

    return $response->getEgressId();
  }

}
