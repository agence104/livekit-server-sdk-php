<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\IngressServiceClient;
use Livekit\IngressInfo;
use Livekit\IngressInput;
use Livekit\ListIngressResponse;
use PHPUnit\Framework\TestCase;

/**
 * Tests the IngressServiceClient class.
 */
class IngressServiceClientTest extends TestCase {

  /**
   * The ingress service client instance.
   */
  private IngressServiceClient $client;

  /**
   * Main room name with participants, created before test execution.
   */
  private string $mainRoom = 'testRoomParticipants';

  /**
   * Sets up the test environment.
   */
  protected function setUp(): void {
    try {
      $this->client = new IngressServiceClient();
    }
    catch (\Exception $e) {
      $this->fail('Failed to set up IngressServiceClient: ' . $e->getMessage());
    }
  }

  /**
   * Tears down the test environment.
   */
  public static function tearDownAfterClass(): void {
    try {
      $client = new IngressServiceClient();
      // Remove all ingress.
      $response = $client->listIngress();
      foreach ($response->getItems() as $ingress) {
        $client->deleteIngress($ingress->getIngressId());
      }
    }
    catch (\Exception $e) {
    }
    parent::tearDownAfterClass();
  }

  /**
   * Validates if an ingress exists.
   *
   * @param string $ingressId
   *   The ingress ID.
   *
   * @return bool
   *   TRUE if the ingress exists, FALSE otherwise.
   */
  private function validateIngressExists(string $ingressId): bool {
    if (empty($ingressId)) {
      $this->fail('Test Ingress not found!');
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Tests creating an ingress.
   */
  public function testCreateIngress(): string {
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
   * Tests updating an ingress.
   *
   * @depends testCreateIngress
   */
  public function testUpdateIngress(string $ingressId): void {
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
   * Tests listing ingresses.
   *
   * @depends testCreateIngress
   */
  public function testListIngress(string $ingressId): void {
    $response = $this->client->listIngress();
    $this->assertInstanceOf(ListIngressResponse::class, $response);
    $this->assertEquals(1, $response->getItems()->count());
    $this->assertEquals(
      $ingressId,
      $response->getItems()[0]->getIngressId()
    );
  }

  /**
   * Tests deleting an ingress.
   *
   * @depends testCreateIngress
   */
  public function testDeleteIngress(string $ingressId): void {
    if (!$this->validateIngressExists($ingressId)) {
      return;
    }

    try {
      $response = $this->client->deleteIngress($ingressId);
      $this->assertInstanceOf(IngressInfo::class, $response);
    }
    catch (\Exception $e) {
      $this->fail('Error deleting Ingress: ' . $e->getMessage());
    }
  }

}
