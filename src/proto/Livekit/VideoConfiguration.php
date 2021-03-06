<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.VideoConfiguration</code>
 */
class VideoConfiguration extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.livekit.ClientConfigSetting hardware_encoder = 1;</code>
     */
    protected $hardware_encoder = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $hardware_encoder
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitModels::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.livekit.ClientConfigSetting hardware_encoder = 1;</code>
     * @return int
     */
    public function getHardwareEncoder()
    {
        return $this->hardware_encoder;
    }

    /**
     * Generated from protobuf field <code>.livekit.ClientConfigSetting hardware_encoder = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setHardwareEncoder($var)
    {
        GPBUtil::checkEnum($var, \Livekit\ClientConfigSetting::class);
        $this->hardware_encoder = $var;

        return $this;
    }

}

