<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_agent_dispatch.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.ListAgentDispatchResponse</code>
 */
class ListAgentDispatchResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .livekit.AgentDispatch agent_dispatches = 1;</code>
     */
    private $agent_dispatches;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\AgentDispatch[]|\Google\Protobuf\Internal\RepeatedField $agent_dispatches
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitAgentDispatch::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.AgentDispatch agent_dispatches = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAgentDispatches()
    {
        return $this->agent_dispatches;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.AgentDispatch agent_dispatches = 1;</code>
     * @param \Livekit\AgentDispatch[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAgentDispatches($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Livekit\AgentDispatch::class);
        $this->agent_dispatches = $arr;

        return $this;
    }

}

