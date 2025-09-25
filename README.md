# LiveKit Server API for PHP

Use this SDK to interact with [livekit](https://github.com/livekit/livekit-server) server APIs and create access tokens from your PHP Backend.

## Installation

### Requirements

- php: >= 8.1

### Composer

```
composer require agence104/livekit-server-sdk
```

## Usage

### Environment Variables

You may store credentials in environment variables. If host, api-key or api-secret is not passed in when creating a RoomServiceClient or AccessToken, the values in the following env vars will be used:

- LIVEKIT_URL
- LIVEKIT_API_KEY
- LIVEKIT_API_SECRET

### Creating Access Tokens

Creating a token for participant to join a room.

```php

use Agence104\LiveKit\AccessToken;
use Agence104\LiveKit\AccessTokenOptions;
use Agence104\LiveKit\VideoGrant;

// If this room doesn't exist, it'll be automatically created when the first
// client joins.
$roomName = 'name-of-room';
// The identifier to be used for participant.
$participantName = 'user-name';

// Define the token options.
$tokenOptions = (new AccessTokenOptions())
  ->setIdentity($participantName);

// Define the video grants.
$videoGrant = (new VideoGrant())
  ->setRoomJoin()
  ->setRoomName($roomName);

// Initialize and fetch the JWT Token.
$token = (new AccessToken('api-key', 'secret-key'))
  ->init($tokenOptions)
  ->setGrant($videoGrant)
  ->toJwt();

```

By default, the token expires after 6 hours. you may override this by passing in `ttl` in the access token options. `ttl` is expressed in seconds (as number) .

### Parsing the Access Tokens

Converting the JWT Token into a ClaimGrants.

```php
use Agence104\LiveKit\AccessToken;

// Initialize and parse the JWT Token.
$claimGrants = (new AccessToken('api-key', 'secret-key'))
  ->fromJwt($token);
```

### Permissions in Access Tokens

It's possible to customize the permissions of each participant:

```php
use Agence104\LiveKit\VideoGrant;

$videoGrant = (new VideoGrant())
  ->setRoomJoin() // TRUE by default.
  ->setRoomName('name-of-room')
  ->setCanPublish(FALSE)
  ->setCanSubscribe() // TRUE by default.
  ->setGrant($videoGrant);
```

This will allow the participant to subscribe to tracks, but not publish their own to the room.

### Managing Rooms

`RoomServiceClient` gives you APIs to list, create, and delete rooms. It also requires a pair of api key/secret key to operate.

```php
use Agence104\LiveKit\RoomServiceClient;
use Agence104\LiveKit\RoomCreateOptions;

$host = 'https://my.livekit.host';
$svc = new RoomServiceClient($host, 'api-key', 'secret-key');

// List rooms.
$rooms = $svc->listRooms();

// Create a new room.
$opts = (new RoomCreateOptions())
  ->setName('myroom')
  ->setEmptyTimeout(10)
  ->setMaxParticipants(20);
$room = $svc->createRoom($opts);

// Delete a room.
$svc->deleteRoom('myroom');
```

### Running Tests

We'll utilize Lando to streamline the test execution process. However, should you choose to run the tests on your local
environment directly, you can certainly proceed with that approach.

#### Step 1:

Generate your environment file by duplicating `example.dev` and renaming the copy to `.env`, then enter your credentials
accordingly.

### Step 2:

Start the lando project.

```
lando start
```

#### Step 3:

Generate the LiveKit room that will serve as the testing environment for the majority of the test cases.

```
lando create-test-room
```

#### Step 4:

Initialize 5 test users within the room. Run this command in a separate terminal window.

```
lando start-test-users
```

#### Step 5:

Time to get busy testing.

```
lando test
```

#### Step 6:

Once tests are completed, it is time to clean up.

- End the `lando start-test-users` command.
- Run `lando delete-test-room` to delete the test room.

<!--BEGIN_REPO_NAV-->
<br/><table>
<thead><tr><th colspan="2">LiveKit Ecosystem</th></tr></thead>
<tbody>
<tr><td>LiveKit SDKs</td><td><a href="https://github.com/livekit/client-sdk-js">Browser</a> · <a href="https://github.com/livekit/client-sdk-swift">iOS/macOS/visionOS</a> · <a href="https://github.com/livekit/client-sdk-android">Android</a> · <a href="https://github.com/livekit/client-sdk-flutter">Flutter</a> · <a href="https://github.com/livekit/client-sdk-react-native">React Native</a> · <a href="https://github.com/livekit/rust-sdks">Rust</a> · <a href="https://github.com/livekit/node-sdks">Node.js</a> · <a href="https://github.com/livekit/python-sdks">Python</a> · <a href="https://github.com/livekit/client-sdk-unity">Unity</a> · <a href="https://github.com/livekit/client-sdk-unity-web">Unity (WebGL)</a></td></tr><tr></tr>
<tr><td>Server APIs</td><td><a href="https://github.com/livekit/node-sdks">Node.js</a> · <a href="https://github.com/livekit/server-sdk-go">Golang</a> · <a href="https://github.com/livekit/server-sdk-ruby">Ruby</a> · <a href="https://github.com/livekit/server-sdk-kotlin">Java/Kotlin</a> · <a href="https://github.com/livekit/python-sdks">Python</a> · <a href="https://github.com/livekit/rust-sdks">Rust</a> · <b>PHP (community)</b> · <a href="https://github.com/pabloFuente/livekit-server-sdk-dotnet">.NET (community)</a></td></tr><tr></tr>
<tr><td>UI Components</td><td><a href="https://github.com/livekit/components-js">React</a> · <a href="https://github.com/livekit/components-android">Android Compose</a> · <a href="https://github.com/livekit/components-swift">SwiftUI</a></td></tr><tr></tr>
<tr><td>Agents Frameworks</td><td><a href="https://github.com/livekit/agents">Python</a> · <a href="https://github.com/livekit/agents-js">Node.js</a> · <a href="https://github.com/livekit/agent-playground">Playground</a></td></tr><tr></tr>
<tr><td>Services</td><td><a href="https://github.com/livekit/livekit">LiveKit server</a> · <a href="https://github.com/livekit/egress">Egress</a> · <a href="https://github.com/livekit/ingress">Ingress</a> · <a href="https://github.com/livekit/sip">SIP</a></td></tr><tr></tr>
<tr><td>Resources</td><td><a href="https://docs.livekit.io">Docs</a> · <a href="https://github.com/livekit-examples">Example apps</a> · <a href="https://livekit.io/cloud">Cloud</a> · <a href="https://docs.livekit.io/home/self-hosting/deployment">Self-hosting</a> · <a href="https://github.com/livekit/livekit-cli">CLI</a></td></tr>
</tbody>
</table>
<!--END_REPO_NAV-->
