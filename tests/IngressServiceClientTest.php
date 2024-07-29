<?php

namespace Agence104\LiveKit\Tests;

use Livekit\IngressInfo;
use Livekit\IngressInput;
use PHPUnit\Framework\TestCase;
use Livekit\ListIngressResponse;
use Agence104\LiveKit\IngressServiceClient;

class IngressServiceClientTest extends TestCase {

  /**
   * The ingress service client instance.
   *
   * @var IngressServiceClient
   */
  private $client;

  /**
   * The room name of the main room with participants.
   * This room is created prior to running the tests.
   *
   * @var string
   */
  private $mainRoom = 'testRoomParticipants';

  protected function setUp(): void {
    try {
      $this->client = new IngressServiceClient();
    }
    catch(\Exception $e) {
      $this->fail('Failed to set up IngressServiceClient: ' . $e->getMessage());
    }
  }

  public static function tearDownAfterClass(): void {
    $host = getenv('LIVEKIT_URL') ?: "http://localhost:7880";
    $apiKey = getenv('LIVEKIT_API_KEY');
    $apiSecret = getenv('LIVEKIT_API_SECRET');

    try {
      $client = new IngressServiceClient($host, $apiKey, $apiSecret);
      // Remove all ingress.
      $response = $client->listIngress();
      foreach($response->getItems() as $ingress) {
        $client->deleteIngress($ingress->getIngressId());
      }
    }
    catch(\Exception $e) {}
    parent::tearDownAfterClass();
  }

  private function validateIngressExists($ingressId) {
    if (empty($ingressId)) {
      $this->fail('Test Ingress not found!');
      return false;
    }

    return true;
  }

  public function testCreateIngress() {
    $name = 'testIngress';
    $participantIdentity = 'ingress-test-user';
    $participantName = 'Ingress Test User';
    $response = $this->client->createIngress(
      IngressInput::RTMP_INPUT,
      $name,
      $this->mainRoom,
      $participantIdentity,
      $participantName,
    );
    $this->assertInstanceOf(IngressInfo::class, $response);
    $this->assertNotEmpty($response->getIngressId());
    $this->assertNotEmpty($response->getStreamKey());
    $this->assertNotEmpty($response->getUrl());
    $this->assertEquals($name, $response->getName());
    $this->assertEquals($participantIdentity, $response->getParticipantIdentity());
    $this->assertEquals($participantName, $response->getParticipantName());

    return $response->getIngressId();
  }

  /**
   * @depends testCreateIngress
   */
  public function testUpdateIngress($ingressId) {
    $name = 'testIngress-2';
    $participantIdentity = 'ingress-test-user-2';
    $participantName = 'Ingress Test User 2';

    if (!$this->validateIngressExists($ingressId)) {
      return;
    }

    $response = $this->client->updateIngress(
      $ingressId,
      $name,
      '',
      $participantIdentity,
      $participantName
    );
    $this->assertInstanceOf(IngressInfo::class, $response);
    $this->assertEquals($name, $response->getName());
    $this->assertEquals($participantIdentity, $response->getParticipantIdentity());
    $this->assertEquals($participantName, $response->getParticipantName());
    $this->assertEquals($this->mainRoom, $response->getRoomName());
  }

  /**
   * @depends testCreateIngress
   */
  public function testListIngress($ingressId) {
    $response = $this->client->listIngress();
    $this->assertInstanceOf(ListIngressResponse::class, $response);
    $this->assertEquals(1, $response->getItems()->count());
    $this->assertEquals(
      $ingressId,
      $response->getItems()[0]->getIngressId()
    );
  }

  /**
   * @depends testCreateIngress
   */
  public function testDeleteIngress($ingressId) {
    if (!$this->validateIngressExists($ingressId)) {
      return;
    }

    try {
      $response = $this->client->deleteIngress($ingressId);
      $this->assertInstanceOf(IngressInfo::class, $response);
    }
    catch(\Exception $e) {
      $this->fail('Error deleting Ingress: ' . $e->getMessage());
    }
  }

}
