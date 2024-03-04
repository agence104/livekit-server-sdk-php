<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_rtc.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.SignalResponse</code>
 */
class SignalResponse extends \Google\Protobuf\Internal\Message
{
    protected $message;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\JoinResponse $join
     *           sent when join is accepted
     *     @type \Livekit\SessionDescription $answer
     *           sent when server answers publisher
     *     @type \Livekit\SessionDescription $offer
     *           sent when server is sending subscriber an offer
     *     @type \Livekit\TrickleRequest $trickle
     *           sent when an ICE candidate is available
     *     @type \Livekit\ParticipantUpdate $update
     *           sent when participants in the room has changed
     *     @type \Livekit\TrackPublishedResponse $track_published
     *           sent to the participant when their track has been published
     *     @type \Livekit\LeaveRequest $leave
     *           Immediately terminate session
     *     @type \Livekit\MuteTrackRequest $mute
     *           server initiated mute
     *     @type \Livekit\SpeakersChanged $speakers_changed
     *           indicates changes to speaker status, including when they've gone to not speaking
     *     @type \Livekit\RoomUpdate $room_update
     *           sent when metadata of the room has changed
     *     @type \Livekit\ConnectionQualityUpdate $connection_quality
     *           when connection quality changed
     *     @type \Livekit\StreamStateUpdate $stream_state_update
     *           when streamed tracks state changed, used to notify when any of the streams were paused due to
     *           congestion
     *     @type \Livekit\SubscribedQualityUpdate $subscribed_quality_update
     *           when max subscribe quality changed, used by dynamic broadcasting to disable unused layers
     *     @type \Livekit\SubscriptionPermissionUpdate $subscription_permission_update
     *           when subscription permission changed
     *     @type string $refresh_token
     *           update the token the client was using, to prevent an active client from using an expired token
     *     @type \Livekit\TrackUnpublishedResponse $track_unpublished
     *           server initiated track unpublish
     *     @type int|string $pong
     *           respond to ping
     *     @type \Livekit\ReconnectResponse $reconnect
     *           sent when client reconnects
     *     @type \Livekit\Pong $pong_resp
     *           respond to Ping
     *     @type \Livekit\SubscriptionResponse $subscription_response
     *           Subscription response, client should not expect any media from this subscription if it fails
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitRtc::initOnce();
        parent::__construct($data);
    }

    /**
     * sent when join is accepted
     *
     * Generated from protobuf field <code>.livekit.JoinResponse join = 1;</code>
     * @return \Livekit\JoinResponse|null
     */
    public function getJoin()
    {
        return $this->readOneof(1);
    }

    public function hasJoin()
    {
        return $this->hasOneof(1);
    }

    /**
     * sent when join is accepted
     *
     * Generated from protobuf field <code>.livekit.JoinResponse join = 1;</code>
     * @param \Livekit\JoinResponse $var
     * @return $this
     */
    public function setJoin($var)
    {
        GPBUtil::checkMessage($var, \Livekit\JoinResponse::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * sent when server answers publisher
     *
     * Generated from protobuf field <code>.livekit.SessionDescription answer = 2;</code>
     * @return \Livekit\SessionDescription|null
     */
    public function getAnswer()
    {
        return $this->readOneof(2);
    }

    public function hasAnswer()
    {
        return $this->hasOneof(2);
    }

    /**
     * sent when server answers publisher
     *
     * Generated from protobuf field <code>.livekit.SessionDescription answer = 2;</code>
     * @param \Livekit\SessionDescription $var
     * @return $this
     */
    public function setAnswer($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SessionDescription::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * sent when server is sending subscriber an offer
     *
     * Generated from protobuf field <code>.livekit.SessionDescription offer = 3;</code>
     * @return \Livekit\SessionDescription|null
     */
    public function getOffer()
    {
        return $this->readOneof(3);
    }

    public function hasOffer()
    {
        return $this->hasOneof(3);
    }

    /**
     * sent when server is sending subscriber an offer
     *
     * Generated from protobuf field <code>.livekit.SessionDescription offer = 3;</code>
     * @param \Livekit\SessionDescription $var
     * @return $this
     */
    public function setOffer($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SessionDescription::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * sent when an ICE candidate is available
     *
     * Generated from protobuf field <code>.livekit.TrickleRequest trickle = 4;</code>
     * @return \Livekit\TrickleRequest|null
     */
    public function getTrickle()
    {
        return $this->readOneof(4);
    }

    public function hasTrickle()
    {
        return $this->hasOneof(4);
    }

    /**
     * sent when an ICE candidate is available
     *
     * Generated from protobuf field <code>.livekit.TrickleRequest trickle = 4;</code>
     * @param \Livekit\TrickleRequest $var
     * @return $this
     */
    public function setTrickle($var)
    {
        GPBUtil::checkMessage($var, \Livekit\TrickleRequest::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * sent when participants in the room has changed
     *
     * Generated from protobuf field <code>.livekit.ParticipantUpdate update = 5;</code>
     * @return \Livekit\ParticipantUpdate|null
     */
    public function getUpdate()
    {
        return $this->readOneof(5);
    }

    public function hasUpdate()
    {
        return $this->hasOneof(5);
    }

    /**
     * sent when participants in the room has changed
     *
     * Generated from protobuf field <code>.livekit.ParticipantUpdate update = 5;</code>
     * @param \Livekit\ParticipantUpdate $var
     * @return $this
     */
    public function setUpdate($var)
    {
        GPBUtil::checkMessage($var, \Livekit\ParticipantUpdate::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * sent to the participant when their track has been published
     *
     * Generated from protobuf field <code>.livekit.TrackPublishedResponse track_published = 6;</code>
     * @return \Livekit\TrackPublishedResponse|null
     */
    public function getTrackPublished()
    {
        return $this->readOneof(6);
    }

    public function hasTrackPublished()
    {
        return $this->hasOneof(6);
    }

    /**
     * sent to the participant when their track has been published
     *
     * Generated from protobuf field <code>.livekit.TrackPublishedResponse track_published = 6;</code>
     * @param \Livekit\TrackPublishedResponse $var
     * @return $this
     */
    public function setTrackPublished($var)
    {
        GPBUtil::checkMessage($var, \Livekit\TrackPublishedResponse::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * Immediately terminate session
     *
     * Generated from protobuf field <code>.livekit.LeaveRequest leave = 8;</code>
     * @return \Livekit\LeaveRequest|null
     */
    public function getLeave()
    {
        return $this->readOneof(8);
    }

    public function hasLeave()
    {
        return $this->hasOneof(8);
    }

    /**
     * Immediately terminate session
     *
     * Generated from protobuf field <code>.livekit.LeaveRequest leave = 8;</code>
     * @param \Livekit\LeaveRequest $var
     * @return $this
     */
    public function setLeave($var)
    {
        GPBUtil::checkMessage($var, \Livekit\LeaveRequest::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * server initiated mute
     *
     * Generated from protobuf field <code>.livekit.MuteTrackRequest mute = 9;</code>
     * @return \Livekit\MuteTrackRequest|null
     */
    public function getMute()
    {
        return $this->readOneof(9);
    }

    public function hasMute()
    {
        return $this->hasOneof(9);
    }

    /**
     * server initiated mute
     *
     * Generated from protobuf field <code>.livekit.MuteTrackRequest mute = 9;</code>
     * @param \Livekit\MuteTrackRequest $var
     * @return $this
     */
    public function setMute($var)
    {
        GPBUtil::checkMessage($var, \Livekit\MuteTrackRequest::class);
        $this->writeOneof(9, $var);

        return $this;
    }

    /**
     * indicates changes to speaker status, including when they've gone to not speaking
     *
     * Generated from protobuf field <code>.livekit.SpeakersChanged speakers_changed = 10;</code>
     * @return \Livekit\SpeakersChanged|null
     */
    public function getSpeakersChanged()
    {
        return $this->readOneof(10);
    }

    public function hasSpeakersChanged()
    {
        return $this->hasOneof(10);
    }

    /**
     * indicates changes to speaker status, including when they've gone to not speaking
     *
     * Generated from protobuf field <code>.livekit.SpeakersChanged speakers_changed = 10;</code>
     * @param \Livekit\SpeakersChanged $var
     * @return $this
     */
    public function setSpeakersChanged($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SpeakersChanged::class);
        $this->writeOneof(10, $var);

        return $this;
    }

    /**
     * sent when metadata of the room has changed
     *
     * Generated from protobuf field <code>.livekit.RoomUpdate room_update = 11;</code>
     * @return \Livekit\RoomUpdate|null
     */
    public function getRoomUpdate()
    {
        return $this->readOneof(11);
    }

    public function hasRoomUpdate()
    {
        return $this->hasOneof(11);
    }

    /**
     * sent when metadata of the room has changed
     *
     * Generated from protobuf field <code>.livekit.RoomUpdate room_update = 11;</code>
     * @param \Livekit\RoomUpdate $var
     * @return $this
     */
    public function setRoomUpdate($var)
    {
        GPBUtil::checkMessage($var, \Livekit\RoomUpdate::class);
        $this->writeOneof(11, $var);

        return $this;
    }

    /**
     * when connection quality changed
     *
     * Generated from protobuf field <code>.livekit.ConnectionQualityUpdate connection_quality = 12;</code>
     * @return \Livekit\ConnectionQualityUpdate|null
     */
    public function getConnectionQuality()
    {
        return $this->readOneof(12);
    }

    public function hasConnectionQuality()
    {
        return $this->hasOneof(12);
    }

    /**
     * when connection quality changed
     *
     * Generated from protobuf field <code>.livekit.ConnectionQualityUpdate connection_quality = 12;</code>
     * @param \Livekit\ConnectionQualityUpdate $var
     * @return $this
     */
    public function setConnectionQuality($var)
    {
        GPBUtil::checkMessage($var, \Livekit\ConnectionQualityUpdate::class);
        $this->writeOneof(12, $var);

        return $this;
    }

    /**
     * when streamed tracks state changed, used to notify when any of the streams were paused due to
     * congestion
     *
     * Generated from protobuf field <code>.livekit.StreamStateUpdate stream_state_update = 13;</code>
     * @return \Livekit\StreamStateUpdate|null
     */
    public function getStreamStateUpdate()
    {
        return $this->readOneof(13);
    }

    public function hasStreamStateUpdate()
    {
        return $this->hasOneof(13);
    }

    /**
     * when streamed tracks state changed, used to notify when any of the streams were paused due to
     * congestion
     *
     * Generated from protobuf field <code>.livekit.StreamStateUpdate stream_state_update = 13;</code>
     * @param \Livekit\StreamStateUpdate $var
     * @return $this
     */
    public function setStreamStateUpdate($var)
    {
        GPBUtil::checkMessage($var, \Livekit\StreamStateUpdate::class);
        $this->writeOneof(13, $var);

        return $this;
    }

    /**
     * when max subscribe quality changed, used by dynamic broadcasting to disable unused layers
     *
     * Generated from protobuf field <code>.livekit.SubscribedQualityUpdate subscribed_quality_update = 14;</code>
     * @return \Livekit\SubscribedQualityUpdate|null
     */
    public function getSubscribedQualityUpdate()
    {
        return $this->readOneof(14);
    }

    public function hasSubscribedQualityUpdate()
    {
        return $this->hasOneof(14);
    }

    /**
     * when max subscribe quality changed, used by dynamic broadcasting to disable unused layers
     *
     * Generated from protobuf field <code>.livekit.SubscribedQualityUpdate subscribed_quality_update = 14;</code>
     * @param \Livekit\SubscribedQualityUpdate $var
     * @return $this
     */
    public function setSubscribedQualityUpdate($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SubscribedQualityUpdate::class);
        $this->writeOneof(14, $var);

        return $this;
    }

    /**
     * when subscription permission changed
     *
     * Generated from protobuf field <code>.livekit.SubscriptionPermissionUpdate subscription_permission_update = 15;</code>
     * @return \Livekit\SubscriptionPermissionUpdate|null
     */
    public function getSubscriptionPermissionUpdate()
    {
        return $this->readOneof(15);
    }

    public function hasSubscriptionPermissionUpdate()
    {
        return $this->hasOneof(15);
    }

    /**
     * when subscription permission changed
     *
     * Generated from protobuf field <code>.livekit.SubscriptionPermissionUpdate subscription_permission_update = 15;</code>
     * @param \Livekit\SubscriptionPermissionUpdate $var
     * @return $this
     */
    public function setSubscriptionPermissionUpdate($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SubscriptionPermissionUpdate::class);
        $this->writeOneof(15, $var);

        return $this;
    }

    /**
     * update the token the client was using, to prevent an active client from using an expired token
     *
     * Generated from protobuf field <code>string refresh_token = 16;</code>
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->readOneof(16);
    }

    public function hasRefreshToken()
    {
        return $this->hasOneof(16);
    }

    /**
     * update the token the client was using, to prevent an active client from using an expired token
     *
     * Generated from protobuf field <code>string refresh_token = 16;</code>
     * @param string $var
     * @return $this
     */
    public function setRefreshToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(16, $var);

        return $this;
    }

    /**
     * server initiated track unpublish
     *
     * Generated from protobuf field <code>.livekit.TrackUnpublishedResponse track_unpublished = 17;</code>
     * @return \Livekit\TrackUnpublishedResponse|null
     */
    public function getTrackUnpublished()
    {
        return $this->readOneof(17);
    }

    public function hasTrackUnpublished()
    {
        return $this->hasOneof(17);
    }

    /**
     * server initiated track unpublish
     *
     * Generated from protobuf field <code>.livekit.TrackUnpublishedResponse track_unpublished = 17;</code>
     * @param \Livekit\TrackUnpublishedResponse $var
     * @return $this
     */
    public function setTrackUnpublished($var)
    {
        GPBUtil::checkMessage($var, \Livekit\TrackUnpublishedResponse::class);
        $this->writeOneof(17, $var);

        return $this;
    }

    /**
     * respond to ping
     *
     * Generated from protobuf field <code>int64 pong = 18;</code>
     * @return int|string
     */
    public function getPong()
    {
        return $this->readOneof(18);
    }

    public function hasPong()
    {
        return $this->hasOneof(18);
    }

    /**
     * respond to ping
     *
     * Generated from protobuf field <code>int64 pong = 18;</code>
     * @param int|string $var
     * @return $this
     */
    public function setPong($var)
    {
        GPBUtil::checkInt64($var);
        $this->writeOneof(18, $var);

        return $this;
    }

    /**
     * sent when client reconnects
     *
     * Generated from protobuf field <code>.livekit.ReconnectResponse reconnect = 19;</code>
     * @return \Livekit\ReconnectResponse|null
     */
    public function getReconnect()
    {
        return $this->readOneof(19);
    }

    public function hasReconnect()
    {
        return $this->hasOneof(19);
    }

    /**
     * sent when client reconnects
     *
     * Generated from protobuf field <code>.livekit.ReconnectResponse reconnect = 19;</code>
     * @param \Livekit\ReconnectResponse $var
     * @return $this
     */
    public function setReconnect($var)
    {
        GPBUtil::checkMessage($var, \Livekit\ReconnectResponse::class);
        $this->writeOneof(19, $var);

        return $this;
    }

    /**
     * respond to Ping
     *
     * Generated from protobuf field <code>.livekit.Pong pong_resp = 20;</code>
     * @return \Livekit\Pong|null
     */
    public function getPongResp()
    {
        return $this->readOneof(20);
    }

    public function hasPongResp()
    {
        return $this->hasOneof(20);
    }

    /**
     * respond to Ping
     *
     * Generated from protobuf field <code>.livekit.Pong pong_resp = 20;</code>
     * @param \Livekit\Pong $var
     * @return $this
     */
    public function setPongResp($var)
    {
        GPBUtil::checkMessage($var, \Livekit\Pong::class);
        $this->writeOneof(20, $var);

        return $this;
    }

    /**
     * Subscription response, client should not expect any media from this subscription if it fails
     *
     * Generated from protobuf field <code>.livekit.SubscriptionResponse subscription_response = 21;</code>
     * @return \Livekit\SubscriptionResponse|null
     */
    public function getSubscriptionResponse()
    {
        return $this->readOneof(21);
    }

    public function hasSubscriptionResponse()
    {
        return $this->hasOneof(21);
    }

    /**
     * Subscription response, client should not expect any media from this subscription if it fails
     *
     * Generated from protobuf field <code>.livekit.SubscriptionResponse subscription_response = 21;</code>
     * @param \Livekit\SubscriptionResponse $var
     * @return $this
     */
    public function setSubscriptionResponse($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SubscriptionResponse::class);
        $this->writeOneof(21, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->whichOneof("message");
    }

}
