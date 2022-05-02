# LiveKit Server API for PHP

PHP APIs to manage rooms and to create access tokens. This library is designed to work with [livekit-server](https://github.com/livekit/livekit-server). Use it with a PHP backend to manage access to LiveKit.

## Installation

### Composer

```
composer require agence104/livekit-server-sdk
```

## Usage

### Creating Access Tokens

Creating a token for participant to join a room.

```php
// If this room doesn't exist, it'll be automatically created when the first
// client joins.
$roomName = 'name-of-room';
// Identifier to be used for participant.
$participantName = 'user-name';

// Define token options.
$tokenOptions = new AccessTokenOptions();
$tokenOptions->setIdentity($participantName);

$accessToken = new AccessToken('api-key', 'secret-key', $tokenOptions);
$videoGrant = new VideoGrant();
$videoGrant->setRoomJoin();
$videoGrant->setRoomName($roomName);
$accessToken->addGrant($videoGrant);
$token = $accessToken->getToken();
```

By default, the token expires after 6 hours. you may override this by passing in `ttl` in the access token options. `ttl` is expressed in seconds (as number) or a string describing a time span [vercel/ms](https://github.com/vercel/ms). eg: '2 days', '10h'.

### Permissions in Access Tokens

It's possible to customize the permissions of each participant:

```php
$videoGrant = new VideoGrant();
$videoGrant->setRoomJoin(); // TRUE by default.
$videoGrant->setRoomName('name-of-room');
$videoGrant->setCanPublish(FALSE);
$videoGrant->setCanSubscribe(); // TRUE by default.
$accessToken->addGrant($videoGrant);
```

This will allow the participant to subscribe to tracks, but not publish their own to the room.
