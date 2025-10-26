<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\AccessToken;
use Agence104\LiveKit\AccessTokenOptions;
use Agence104\LiveKit\RoomAgentDispatch;
use Agence104\LiveKit\RoomConfiguration;
use Agence104\LiveKit\SIPGrant;
use Agence104\LiveKit\VideoGrant;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPUnit\Framework\TestCase;

/**
 * Test the AccessToken class.
 */
class AccessTokenTest extends TestCase {

  /**
   * The test API key.
   */
  protected string $testApiKey = 'abcdefg';

  /**
   * The test API secret.
   */
  protected string $testSecret = 'abababa';

  /**
   * Test that encoded tokens are valid and can be decoded.
   */
  public function testEncodedTokensAreValid(): void {
    $options = (new AccessTokenOptions())
      ->setIdentity('me')
      ->setName('myname');

    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomName('myroom');
    $token->setGrant($videoGrant);

    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertNotNull($decoded);
    $this->assertEquals('myname', $decoded->name);
    $this->assertTrue(isset($decoded->video));
    $this->assertEquals('myroom', $decoded->video->room);
  }

  /**
   * Test that identity is required only for join grants.
   */
  public function testIdentityRequirements(): void {
    // Test empty identity for create.
    $options = (new AccessTokenOptions())
      ->setIdentity('me')
      ->setName('myname');
    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();
    $token->setGrant($videoGrant);

    $this->assertNotEmpty($token->toJwt());

    // Test error when identity is not provided for join.
    $token = new AccessToken($this->testApiKey, $this->testSecret);
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomJoin();
    $token->setGrant($videoGrant);

    $this->expectException(\Exception::class);
    $token->toJwt();
  }

  /**
   * Test that token verification works correctly.
   */
  public function testTokenVerification(): void {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();

    $sipGrant = new SIPGrant();
    $sipGrant->setAdmin();

    $token = new AccessToken($this->testApiKey, $this->testSecret);
    $token->setSha256('abcdefg');
    $token->setGrant($videoGrant);
    $token->setSipGrant($sipGrant);
    $token->setAttributes(['foo' => 'bar', 'live' => 'kit']);
    $jwt = $token->toJwt();

    $token = new AccessToken($this->testApiKey, $this->testSecret);
    $decoded = $token->fromJwt($jwt);

    $this->assertNotNull($decoded);
    $this->assertEquals('abcdefg', $decoded->getSha256());
    $this->assertTrue($decoded->getVideoGrant()->isRoomCreate());
    $this->assertTrue($decoded->getSipGrant()->isAdmin());
    $this->assertEquals(['foo' => 'bar', 'live' => 'kit'], $decoded->getAttributes());
  }

  /**
   * Test that adding grants does not overwrite existing grants.
   */
  public function testGrantsNotOverwritten(): void {
    $options = new AccessTokenOptions();
    $options->setIdentity('me');
    $options->setName('myname');

    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomCreate();
    $videoGrant->setRoomJoin();
    $token->setGrant($videoGrant);

    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertTrue($decoded->video->roomCreate);
    $this->assertTrue($decoded->video->roomJoin);
  }

  /**
   * Test SIP grant functionality.
   */
  public function testSipGrant(): void {
    $options = new AccessTokenOptions();
    $options->setIdentity('me');
    $options->setName('myname');

    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);

    $sipGrant = new SIPGrant();
    $sipGrant->setAdmin();
    $token->setSipGrant($sipGrant);

    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertTrue($decoded->sip->admin);
    $this->assertFalse(isset($decoded->sip->call));

    // Test call grant.
    $sipGrant = new SIPGrant();
    $sipGrant->setCall();
    $token->setSipGrant($sipGrant);

    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertTrue($decoded->sip->call);
    $this->assertFalse(isset($decoded->sip->admin));
  }

  /**
   * Test that metadata is properly set and retrieved.
   */
  public function testMetadata(): void {
    $options = new AccessTokenOptions();
    $options->setIdentity('me');
    $options->setName('myname');
    $options->setMetadata('{"key":"value"}');

    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);
    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertEquals('{"key":"value"}', $decoded->metadata);
  }

  /**
   * Test that attributes are properly set and retrieved.
   */
  public function testAttributes(): void {
    $options = new AccessTokenOptions();
    $options->setIdentity('me');
    $options->setAttributes([
      'department' => 'engineering',
      'role' => 'admin',
    ]);

    $token = new AccessToken($this->testApiKey, $this->testSecret, $options);
    $jwt = $token->toJwt();
    $decoded = JWT::decode($jwt, new Key($this->testSecret, 'HS256'));

    $this->assertEquals('engineering', $decoded->attributes->department);
    $this->assertEquals('admin', $decoded->attributes->role);
  }

  /**
   * Test that RoomAgentDispatch class works correctly.
   */
  public function testRoomAgentDispatch(): void {
    // Test empty constructor
    $agent = new RoomAgentDispatch();
    $this->assertNull($agent->getAgentName());
    $this->assertNull($agent->getMetadata());
    $this->assertEquals([], $agent->getData());

    // Test constructor with properties
    $agent = new RoomAgentDispatch([
      'agentName' => 'my-agent',
      'metadata' => 'agent metadata',
    ]);
    $this->assertEquals('my-agent', $agent->getAgentName());
    $this->assertEquals('agent metadata', $agent->getMetadata());
    $this->assertEquals([
      'agentName' => 'my-agent',
      'metadata' => 'agent metadata',
    ], $agent->getData());

    // Test setters with method chaining
    $agent = (new RoomAgentDispatch())
      ->setAgentName('test-agent')
      ->setMetadata('test metadata');
    
    $this->assertEquals('test-agent', $agent->getAgentName());
    $this->assertEquals('test metadata', $agent->getMetadata());
    $this->assertEquals([
      'agentName' => 'test-agent',
      'metadata' => 'test metadata',
    ], $agent->getData());

    // Test getData() filters null values
    $agent = new RoomAgentDispatch(['agentName' => 'only-name']);
    $this->assertEquals(['agentName' => 'only-name'], $agent->getData());

    $agent = new RoomAgentDispatch(['metadata' => 'only-metadata']);
    $this->assertEquals(['metadata' => 'only-metadata'], $agent->getData());
  }

  /**
   * Test that RoomConfiguration class works correctly with agent dispatch.
   */
  public function testRoomConfiguration(): void {
    // Test constructor with properties
    $config = new RoomConfiguration([
      'name' => 'test-room',
      'emptyTimeout' => 60,
      'maxParticipants' => 10,
    ]);
    $this->assertEquals('test-room', $config->getName());
    $this->assertEquals(60, $config->getEmptyTimeout());
    $this->assertEquals(10, $config->getMaxParticipants());
    $this->assertNull($config->getAgents());

    // Test all getters/setters
    $config = new RoomConfiguration();
    $config->setName('my-room')
      ->setEmptyTimeout(120)
      ->setDepartureTimeout(60)
      ->setMaxParticipants(50)
      ->setMinPlayoutDelay(100)
      ->setMaxPlayoutDelay(500)
      ->setSyncStreams(TRUE);

    $this->assertEquals('my-room', $config->getName());
    $this->assertEquals(120, $config->getEmptyTimeout());
    $this->assertEquals(60, $config->getDepartureTimeout());
    $this->assertEquals(50, $config->getMaxParticipants());
    $this->assertEquals(100, $config->getMinPlayoutDelay());
    $this->assertEquals(500, $config->getMaxPlayoutDelay());
    $this->assertTrue($config->isSyncStreams());

    // Test getData without agents
    $data = $config->getData();
    $this->assertEquals('my-room', $data['name']);
    $this->assertEquals(120, $data['emptyTimeout']);
    $this->assertEquals(60, $data['departureTimeout']);
    $this->assertEquals(50, $data['maxParticipants']);
    $this->assertEquals(100, $data['minPlayoutDelay']);
    $this->assertEquals(500, $data['maxPlayoutDelay']);
    $this->assertTrue($data['syncStreams']);
    $this->assertArrayNotHasKey('agents', $data);

    // Test agents property with RoomAgentDispatch
    $agent1 = (new RoomAgentDispatch())
      ->setAgentName('agent-1')
      ->setMetadata('metadata-1');
    
    $agent2 = (new RoomAgentDispatch())
      ->setAgentName('agent-2');

    $config->setAgents([$agent1, $agent2]);
    $this->assertCount(2, $config->getAgents());
    $this->assertEquals($agent1, $config->getAgents()[0]);
    $this->assertEquals($agent2, $config->getAgents()[1]);

    // Test getData with agents serialization
    $data = $config->getData();
    $this->assertArrayHasKey('agents', $data);
    $this->assertCount(2, $data['agents']);
    $this->assertEquals([
      'agentName' => 'agent-1',
      'metadata' => 'metadata-1',
    ], $data['agents'][0]);
    $this->assertEquals([
      'agentName' => 'agent-2',
    ], $data['agents'][1]);

    // Test integration with AccessTokenOptions
    $options = new AccessTokenOptions();
    $options->setIdentity('me');
    $options->setRoomConfig($config);

    $this->assertEquals($config, $options->getRoomConfig());
  }

}
