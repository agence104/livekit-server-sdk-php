<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_sip.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.CreateSIPDispatchRuleRequest</code>
 */
class CreateSIPDispatchRuleRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 1;</code>
     */
    protected $rule = null;
    /**
     * What trunks are accepted for this dispatch rule
     * If empty all trunks will match this dispatch rule
     *
     * Generated from protobuf field <code>repeated string trunk_ids = 2;</code>
     */
    private $trunk_ids;
    /**
     * By default the From value (Phone number) is used for participant name/identity and added to attributes.
     * If true, a random value for identity will be used and numbers will be omitted from attributes.
     *
     * Generated from protobuf field <code>bool hide_phone_number = 3;</code>
     */
    protected $hide_phone_number = false;
    /**
     * Dispatch Rule will only accept a call made to these numbers (if set).
     *
     * Generated from protobuf field <code>repeated string inbound_numbers = 6;</code>
     */
    private $inbound_numbers;
    /**
     * Optional human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 4;</code>
     */
    protected $name = '';
    /**
     * User-defined metadata for the Dispatch Rule.
     * Participants created by this rule will inherit this metadata.
     *
     * Generated from protobuf field <code>string metadata = 5;</code>
     */
    protected $metadata = '';
    /**
     * User-defined attributes for the Dispatch Rule.
     * Participants created by this rule will inherit these attributes.
     *
     * Generated from protobuf field <code>map<string, string> attributes = 7;</code>
     */
    private $attributes;
    /**
     * Cloud-only, config preset to use
     *
     * Generated from protobuf field <code>string room_preset = 8;</code>
     */
    protected $room_preset = '';
    /**
     * RoomConfiguration to use if the participant initiates the room
     *
     * Generated from protobuf field <code>.livekit.RoomConfiguration room_config = 9;</code>
     */
    protected $room_config = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\SIPDispatchRule $rule
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $trunk_ids
     *           What trunks are accepted for this dispatch rule
     *           If empty all trunks will match this dispatch rule
     *     @type bool $hide_phone_number
     *           By default the From value (Phone number) is used for participant name/identity and added to attributes.
     *           If true, a random value for identity will be used and numbers will be omitted from attributes.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $inbound_numbers
     *           Dispatch Rule will only accept a call made to these numbers (if set).
     *     @type string $name
     *           Optional human-readable name for the Dispatch Rule.
     *     @type string $metadata
     *           User-defined metadata for the Dispatch Rule.
     *           Participants created by this rule will inherit this metadata.
     *     @type array|\Google\Protobuf\Internal\MapField $attributes
     *           User-defined attributes for the Dispatch Rule.
     *           Participants created by this rule will inherit these attributes.
     *     @type string $room_preset
     *           Cloud-only, config preset to use
     *     @type \Livekit\RoomConfiguration $room_config
     *           RoomConfiguration to use if the participant initiates the room
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitSip::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 1;</code>
     * @return \Livekit\SIPDispatchRule|null
     */
    public function getRule()
    {
        return $this->rule;
    }

    public function hasRule()
    {
        return isset($this->rule);
    }

    public function clearRule()
    {
        unset($this->rule);
    }

    /**
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 1;</code>
     * @param \Livekit\SIPDispatchRule $var
     * @return $this
     */
    public function setRule($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SIPDispatchRule::class);
        $this->rule = $var;

        return $this;
    }

    /**
     * What trunks are accepted for this dispatch rule
     * If empty all trunks will match this dispatch rule
     *
     * Generated from protobuf field <code>repeated string trunk_ids = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTrunkIds()
    {
        return $this->trunk_ids;
    }

    /**
     * What trunks are accepted for this dispatch rule
     * If empty all trunks will match this dispatch rule
     *
     * Generated from protobuf field <code>repeated string trunk_ids = 2;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTrunkIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->trunk_ids = $arr;

        return $this;
    }

    /**
     * By default the From value (Phone number) is used for participant name/identity and added to attributes.
     * If true, a random value for identity will be used and numbers will be omitted from attributes.
     *
     * Generated from protobuf field <code>bool hide_phone_number = 3;</code>
     * @return bool
     */
    public function getHidePhoneNumber()
    {
        return $this->hide_phone_number;
    }

    /**
     * By default the From value (Phone number) is used for participant name/identity and added to attributes.
     * If true, a random value for identity will be used and numbers will be omitted from attributes.
     *
     * Generated from protobuf field <code>bool hide_phone_number = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setHidePhoneNumber($var)
    {
        GPBUtil::checkBool($var);
        $this->hide_phone_number = $var;

        return $this;
    }

    /**
     * Dispatch Rule will only accept a call made to these numbers (if set).
     *
     * Generated from protobuf field <code>repeated string inbound_numbers = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInboundNumbers()
    {
        return $this->inbound_numbers;
    }

    /**
     * Dispatch Rule will only accept a call made to these numbers (if set).
     *
     * Generated from protobuf field <code>repeated string inbound_numbers = 6;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setInboundNumbers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->inbound_numbers = $arr;

        return $this;
    }

    /**
     * Optional human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 4;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Optional human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 4;</code>
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
     * User-defined metadata for the Dispatch Rule.
     * Participants created by this rule will inherit this metadata.
     *
     * Generated from protobuf field <code>string metadata = 5;</code>
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * User-defined metadata for the Dispatch Rule.
     * Participants created by this rule will inherit this metadata.
     *
     * Generated from protobuf field <code>string metadata = 5;</code>
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
     * User-defined attributes for the Dispatch Rule.
     * Participants created by this rule will inherit these attributes.
     *
     * Generated from protobuf field <code>map<string, string> attributes = 7;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * User-defined attributes for the Dispatch Rule.
     * Participants created by this rule will inherit these attributes.
     *
     * Generated from protobuf field <code>map<string, string> attributes = 7;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setAttributes($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->attributes = $arr;

        return $this;
    }

    /**
     * Cloud-only, config preset to use
     *
     * Generated from protobuf field <code>string room_preset = 8;</code>
     * @return string
     */
    public function getRoomPreset()
    {
        return $this->room_preset;
    }

    /**
     * Cloud-only, config preset to use
     *
     * Generated from protobuf field <code>string room_preset = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setRoomPreset($var)
    {
        GPBUtil::checkString($var, True);
        $this->room_preset = $var;

        return $this;
    }

    /**
     * RoomConfiguration to use if the participant initiates the room
     *
     * Generated from protobuf field <code>.livekit.RoomConfiguration room_config = 9;</code>
     * @return \Livekit\RoomConfiguration|null
     */
    public function getRoomConfig()
    {
        return $this->room_config;
    }

    public function hasRoomConfig()
    {
        return isset($this->room_config);
    }

    public function clearRoomConfig()
    {
        unset($this->room_config);
    }

    /**
     * RoomConfiguration to use if the participant initiates the room
     *
     * Generated from protobuf field <code>.livekit.RoomConfiguration room_config = 9;</code>
     * @param \Livekit\RoomConfiguration $var
     * @return $this
     */
    public function setRoomConfig($var)
    {
        GPBUtil::checkMessage($var, \Livekit\RoomConfiguration::class);
        $this->room_config = $var;

        return $this;
    }

}

