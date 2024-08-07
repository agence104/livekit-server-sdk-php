<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_room.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.RoomAgent</code>
 */
class RoomAgent extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .livekit.RoomAgentDispatch dispatches = 1;</code>
     */
    private $dispatches;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\RoomAgentDispatch[]|\Google\Protobuf\Internal\RepeatedField $dispatches
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitRoom::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.RoomAgentDispatch dispatches = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDispatches()
    {
        return $this->dispatches;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.RoomAgentDispatch dispatches = 1;</code>
     * @param \Livekit\RoomAgentDispatch[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDispatches($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Livekit\RoomAgentDispatch::class);
        $this->dispatches = $arr;

        return $this;
    }

}

