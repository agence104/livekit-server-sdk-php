<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.Room</code>
 */
class Room extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     */
    protected $sid = '';
    /**
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>uint32 empty_timeout = 3;</code>
     */
    protected $empty_timeout = 0;
    /**
     * Generated from protobuf field <code>uint32 departure_timeout = 14;</code>
     */
    protected $departure_timeout = 0;
    /**
     * Generated from protobuf field <code>uint32 max_participants = 4;</code>
     */
    protected $max_participants = 0;
    /**
     * Generated from protobuf field <code>int64 creation_time = 5;</code>
     */
    protected $creation_time = 0;
    /**
     * Generated from protobuf field <code>int64 creation_time_ms = 15;</code>
     */
    protected $creation_time_ms = 0;
    /**
     * Generated from protobuf field <code>string turn_password = 6;</code>
     */
    protected $turn_password = '';
    /**
     * Generated from protobuf field <code>repeated .livekit.Codec enabled_codecs = 7;</code>
     */
    private $enabled_codecs;
    /**
     * Generated from protobuf field <code>string metadata = 8;</code>
     */
    protected $metadata = '';
    /**
     * Generated from protobuf field <code>uint32 num_participants = 9;</code>
     */
    protected $num_participants = 0;
    /**
     * Generated from protobuf field <code>uint32 num_publishers = 11;</code>
     */
    protected $num_publishers = 0;
    /**
     * Generated from protobuf field <code>bool active_recording = 10;</code>
     */
    protected $active_recording = false;
    /**
     * Generated from protobuf field <code>.livekit.TimedVersion version = 13;</code>
     */
    protected $version = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sid
     *     @type string $name
     *     @type int $empty_timeout
     *     @type int $departure_timeout
     *     @type int $max_participants
     *     @type int|string $creation_time
     *     @type int|string $creation_time_ms
     *     @type string $turn_password
     *     @type \Livekit\Codec[]|\Google\Protobuf\Internal\RepeatedField $enabled_codecs
     *     @type string $metadata
     *     @type int $num_participants
     *     @type int $num_publishers
     *     @type bool $active_recording
     *     @type \Livekit\TimedVersion $version
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitModels::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Generated from protobuf field <code>string sid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSid($var)
    {
        GPBUtil::checkString($var, True);
        $this->sid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 empty_timeout = 3;</code>
     * @return int
     */
    public function getEmptyTimeout()
    {
        return $this->empty_timeout;
    }

    /**
     * Generated from protobuf field <code>uint32 empty_timeout = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setEmptyTimeout($var)
    {
        GPBUtil::checkUint32($var);
        $this->empty_timeout = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 departure_timeout = 14;</code>
     * @return int
     */
    public function getDepartureTimeout()
    {
        return $this->departure_timeout;
    }

    /**
     * Generated from protobuf field <code>uint32 departure_timeout = 14;</code>
     * @param int $var
     * @return $this
     */
    public function setDepartureTimeout($var)
    {
        GPBUtil::checkUint32($var);
        $this->departure_timeout = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 max_participants = 4;</code>
     * @return int
     */
    public function getMaxParticipants()
    {
        return $this->max_participants;
    }

    /**
     * Generated from protobuf field <code>uint32 max_participants = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setMaxParticipants($var)
    {
        GPBUtil::checkUint32($var);
        $this->max_participants = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 creation_time = 5;</code>
     * @return int|string
     */
    public function getCreationTime()
    {
        return $this->creation_time;
    }

    /**
     * Generated from protobuf field <code>int64 creation_time = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setCreationTime($var)
    {
        GPBUtil::checkInt64($var);
        $this->creation_time = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 creation_time_ms = 15;</code>
     * @return int|string
     */
    public function getCreationTimeMs()
    {
        return $this->creation_time_ms;
    }

    /**
     * Generated from protobuf field <code>int64 creation_time_ms = 15;</code>
     * @param int|string $var
     * @return $this
     */
    public function setCreationTimeMs($var)
    {
        GPBUtil::checkInt64($var);
        $this->creation_time_ms = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string turn_password = 6;</code>
     * @return string
     */
    public function getTurnPassword()
    {
        return $this->turn_password;
    }

    /**
     * Generated from protobuf field <code>string turn_password = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setTurnPassword($var)
    {
        GPBUtil::checkString($var, True);
        $this->turn_password = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.Codec enabled_codecs = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getEnabledCodecs()
    {
        return $this->enabled_codecs;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.Codec enabled_codecs = 7;</code>
     * @param \Livekit\Codec[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setEnabledCodecs($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Livekit\Codec::class);
        $this->enabled_codecs = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string metadata = 8;</code>
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Generated from protobuf field <code>string metadata = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setMetadata($var)
    {
        GPBUtil::checkString($var, True);
        $this->metadata = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 num_participants = 9;</code>
     * @return int
     */
    public function getNumParticipants()
    {
        return $this->num_participants;
    }

    /**
     * Generated from protobuf field <code>uint32 num_participants = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setNumParticipants($var)
    {
        GPBUtil::checkUint32($var);
        $this->num_participants = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 num_publishers = 11;</code>
     * @return int
     */
    public function getNumPublishers()
    {
        return $this->num_publishers;
    }

    /**
     * Generated from protobuf field <code>uint32 num_publishers = 11;</code>
     * @param int $var
     * @return $this
     */
    public function setNumPublishers($var)
    {
        GPBUtil::checkUint32($var);
        $this->num_publishers = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool active_recording = 10;</code>
     * @return bool
     */
    public function getActiveRecording()
    {
        return $this->active_recording;
    }

    /**
     * Generated from protobuf field <code>bool active_recording = 10;</code>
     * @param bool $var
     * @return $this
     */
    public function setActiveRecording($var)
    {
        GPBUtil::checkBool($var);
        $this->active_recording = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.TimedVersion version = 13;</code>
     * @return \Livekit\TimedVersion|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    public function hasVersion()
    {
        return isset($this->version);
    }

    public function clearVersion()
    {
        unset($this->version);
    }

    /**
     * Generated from protobuf field <code>.livekit.TimedVersion version = 13;</code>
     * @param \Livekit\TimedVersion $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkMessage($var, \Livekit\TimedVersion::class);
        $this->version = $var;

        return $this;
    }

}

