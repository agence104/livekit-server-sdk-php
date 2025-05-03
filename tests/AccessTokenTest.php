<?php

namespace Agence104\LiveKit\Tests;

use Agence104\LiveKit\AccessToken;
use Agence104\LiveKit\AccessTokenOptions;
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

}
