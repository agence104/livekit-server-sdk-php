<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_sip.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.SIPDispatchRuleInfo</code>
 */
class SIPDispatchRuleInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sip_dispatch_rule_id = 1;</code>
     */
    protected $sip_dispatch_rule_id = '';
    /**
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 2;</code>
     */
    protected $rule = null;
    /**
     * Generated from protobuf field <code>repeated string trunk_ids = 3;</code>
     */
    private $trunk_ids;
    /**
     * Generated from protobuf field <code>bool hide_phone_number = 4;</code>
     */
    protected $hide_phone_number = false;
    /**
     * Dispatch Rule will only accept a call made to these numbers (if set).
     *
     * Generated from protobuf field <code>repeated string inbound_numbers = 7;</code>
     */
    private $inbound_numbers;
    /**
     * Human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 5;</code>
     */
    protected $name = '';
    /**
     * User-defined metadata for the Dispatch Rule.
     * Participants created by this rule will inherit this metadata.
     *
     * Generated from protobuf field <code>string metadata = 6;</code>
     */
    protected $metadata = '';
    /**
     * User-defined attributes for the Dispatch Rule.
     * Participants created by this rule will inherit these attributes.
     *
     * Generated from protobuf field <code>map<string, string> attributes = 8;</code>
     */
    private $attributes;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sip_dispatch_rule_id
     *     @type \Livekit\SIPDispatchRule $rule
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $trunk_ids
     *     @type bool $hide_phone_number
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $inbound_numbers
     *           Dispatch Rule will only accept a call made to these numbers (if set).
     *     @type string $name
     *           Human-readable name for the Dispatch Rule.
     *     @type string $metadata
     *           User-defined metadata for the Dispatch Rule.
     *           Participants created by this rule will inherit this metadata.
     *     @type array|\Google\Protobuf\Internal\MapField $attributes
     *           User-defined attributes for the Dispatch Rule.
     *           Participants created by this rule will inherit these attributes.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitSip::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sip_dispatch_rule_id = 1;</code>
     * @return string
     */
    public function getSipDispatchRuleId()
    {
        return $this->sip_dispatch_rule_id;
    }

    /**
     * Generated from protobuf field <code>string sip_dispatch_rule_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSipDispatchRuleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->sip_dispatch_rule_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 2;</code>
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
     * Generated from protobuf field <code>.livekit.SIPDispatchRule rule = 2;</code>
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
     * Generated from protobuf field <code>repeated string trunk_ids = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTrunkIds()
    {
        return $this->trunk_ids;
    }

    /**
     * Generated from protobuf field <code>repeated string trunk_ids = 3;</code>
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
     * Generated from protobuf field <code>bool hide_phone_number = 4;</code>
     * @return bool
     */
    public function getHidePhoneNumber()
    {
        return $this->hide_phone_number;
    }

    /**
     * Generated from protobuf field <code>bool hide_phone_number = 4;</code>
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
     * Generated from protobuf field <code>repeated string inbound_numbers = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInboundNumbers()
    {
        return $this->inbound_numbers;
    }

    /**
     * Dispatch Rule will only accept a call made to these numbers (if set).
     *
     * Generated from protobuf field <code>repeated string inbound_numbers = 7;</code>
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
     * Human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 5;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Human-readable name for the Dispatch Rule.
     *
     * Generated from protobuf field <code>string name = 5;</code>
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
     * Generated from protobuf field <code>string metadata = 6;</code>
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
     * Generated from protobuf field <code>string metadata = 6;</code>
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
     * Generated from protobuf field <code>map<string, string> attributes = 8;</code>
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
     * Generated from protobuf field <code>map<string, string> attributes = 8;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setAttributes($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->attributes = $arr;

        return $this;
    }

}

