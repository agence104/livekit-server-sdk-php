# LiveKit Server API for PHP

PHP APIs to manage rooms and to create access tokens. This library is designed to work with [livekit-server](https://github.com/livekit/livekit-server). Use it with a PHP backend to manage access to LiveKit.

## Installation

### Composer

```
composer require agence104/livekit-server-sdk
```

## Usage

### Environment Variables
You may store credentials in environment variables. If api-key or api-secret is not passed in when creating a RoomServiceClient or AccessToken, the values in the following env vars will be used:

- LIVEKIT_API_KEY
- LIVEKIT_API_SECRET

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

$accessToken = new AccessToken($tokenOptions, 'api-key', 'secret-key');
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

### Managing Rooms

`RoomServiceClient` gives you APIs to list, create, and delete rooms. It also requires a pair of api key/secret key to operate.

```php

$host = 'https://my.livekit.host';
$svc = new RoomServiceClient($host, 'api-key', 'secret-key');

// List rooms.
$rooms = $svc->listRooms();

// Create a new room.
$svc = new RoomServiceClient($this->host);
$opts = new RoomCreateOptions();
$opts->setName('myroom');
$opts->setEmptyTimeout(10);
$opts->setMaxParticipants(20);
$roomsList = $svc->createRoom($opts);

// Delete a room.
$svc->deleteRoom('myroom');
```