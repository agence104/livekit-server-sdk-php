<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_agent.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.RegisterWorkerRequest</code>
 */
class RegisterWorkerRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.livekit.JobType type = 1;</code>
     */
    protected $type = 0;
    /**
     * Generated from protobuf field <code>string agent_name = 8;</code>
     */
    protected $agent_name = '';
    /**
     * string worker_id = 2;
     *
     * Generated from protobuf field <code>string version = 3;</code>
     */
    protected $version = '';
    /**
     * string name = 4 [deprecated = true];
     *
     * Generated from protobuf field <code>uint32 ping_interval = 5;</code>
     */
    protected $ping_interval = 0;
    /**
     * Generated from protobuf field <code>optional string namespace = 6;</code>
     */
    protected $namespace = null;
    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission allowed_permissions = 7;</code>
     */
    protected $allowed_permissions = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $type
     *     @type string $agent_name
     *     @type string $version
     *           string worker_id = 2;
     *     @type int $ping_interval
     *           string name = 4 [deprecated = true];
     *     @type string $namespace
     *     @type \Livekit\ParticipantPermission $allowed_permissions
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitAgent::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.livekit.JobType type = 1;</code>
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Generated from protobuf field <code>.livekit.JobType type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkEnum($var, \Livekit\JobType::class);
        $this->type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string agent_name = 8;</code>
     * @return string
     */
    public function getAgentName()
    {
        return $this->agent_name;
    }

    /**
     * Generated from protobuf field <code>string agent_name = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setAgentName($var)
    {
        GPBUtil::checkString($var, True);
        $this->agent_name = $var;

        return $this;
    }

    /**
     * string worker_id = 2;
     *
     * Generated from protobuf field <code>string version = 3;</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * string worker_id = 2;
     *
     * Generated from protobuf field <code>string version = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->version = $var;

        return $this;
    }

    /**
     * string name = 4 [deprecated = true];
     *
     * Generated from protobuf field <code>uint32 ping_interval = 5;</code>
     * @return int
     */
    public function getPingInterval()
    {
        return $this->ping_interval;
    }

    /**
     * string name = 4 [deprecated = true];
     *
     * Generated from protobuf field <code>uint32 ping_interval = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setPingInterval($var)
    {
        GPBUtil::checkUint32($var);
        $this->ping_interval = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string namespace = 6;</code>
     * @return string
     */
    public function getNamespace()
    {
        return isset($this->namespace) ? $this->namespace : '';
    }

    public function hasNamespace()
    {
        return isset($this->namespace);
    }

    public function clearNamespace()
    {
        unset($this->namespace);
    }

    /**
     * Generated from protobuf field <code>optional string namespace = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->namespace = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission allowed_permissions = 7;</code>
     * @return \Livekit\ParticipantPermission|null
     */
    public function getAllowedPermissions()
    {
        return $this->allowed_permissions;
    }

    public function hasAllowedPermissions()
    {
        return isset($this->allowed_permissions);
    }

    public function clearAllowedPermissions()
    {
        unset($this->allowed_permissions);
    }

    /**
     * Generated from protobuf field <code>.livekit.ParticipantPermission allowed_permissions = 7;</code>
     * @param \Livekit\ParticipantPermission $var
     * @return $this
     */
    public function setAllowedPermissions($var)
    {
        GPBUtil::checkMessage($var, \Livekit\ParticipantPermission::class);
        $this->allowed_permissions = $var;

        return $this;
    }

}

