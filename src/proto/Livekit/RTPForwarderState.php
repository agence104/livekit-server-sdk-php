<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.RTPForwarderState</code>
 */
class RTPForwarderState extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bool started = 1;</code>
     */
    protected $started = false;
    /**
     * Generated from protobuf field <code>int32 reference_layer_spatial = 2;</code>
     */
    protected $reference_layer_spatial = 0;
    /**
     * Generated from protobuf field <code>int64 pre_start_time = 3;</code>
     */
    protected $pre_start_time = 0;
    /**
     * Generated from protobuf field <code>uint64 ext_first_timestamp = 4;</code>
     */
    protected $ext_first_timestamp = 0;
    /**
     * Generated from protobuf field <code>uint64 dummy_start_timestamp_offset = 5;</code>
     */
    protected $dummy_start_timestamp_offset = 0;
    /**
     * Generated from protobuf field <code>.livekit.RTPMungerState rtp_munger = 6;</code>
     */
    protected $rtp_munger = null;
    /**
     * Generated from protobuf field <code>repeated .livekit.RTCPSenderReportState sender_report_state = 8;</code>
     */
    private $sender_report_state;
    protected $codec_munger;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $started
     *     @type int $reference_layer_spatial
     *     @type int|string $pre_start_time
     *     @type int|string $ext_first_timestamp
     *     @type int|string $dummy_start_timestamp_offset
     *     @type \Livekit\RTPMungerState $rtp_munger
     *     @type \Livekit\VP8MungerState $vp8_munger
     *     @type \Livekit\RTCPSenderReportState[]|\Google\Protobuf\Internal\RepeatedField $sender_report_state
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitModels::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bool started = 1;</code>
     * @return bool
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Generated from protobuf field <code>bool started = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setStarted($var)
    {
        GPBUtil::checkBool($var);
        $this->started = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 reference_layer_spatial = 2;</code>
     * @return int
     */
    public function getReferenceLayerSpatial()
    {
        return $this->reference_layer_spatial;
    }

    /**
     * Generated from protobuf field <code>int32 reference_layer_spatial = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setReferenceLayerSpatial($var)
    {
        GPBUtil::checkInt32($var);
        $this->reference_layer_spatial = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 pre_start_time = 3;</code>
     * @return int|string
     */
    public function getPreStartTime()
    {
        return $this->pre_start_time;
    }

    /**
     * Generated from protobuf field <code>int64 pre_start_time = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setPreStartTime($var)
    {
        GPBUtil::checkInt64($var);
        $this->pre_start_time = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint64 ext_first_timestamp = 4;</code>
     * @return int|string
     */
    public function getExtFirstTimestamp()
    {
        return $this->ext_first_timestamp;
    }

    /**
     * Generated from protobuf field <code>uint64 ext_first_timestamp = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setExtFirstTimestamp($var)
    {
        GPBUtil::checkUint64($var);
        $this->ext_first_timestamp = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint64 dummy_start_timestamp_offset = 5;</code>
     * @return int|string
     */
    public function getDummyStartTimestampOffset()
    {
        return $this->dummy_start_timestamp_offset;
    }

    /**
     * Generated from protobuf field <code>uint64 dummy_start_timestamp_offset = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setDummyStartTimestampOffset($var)
    {
        GPBUtil::checkUint64($var);
        $this->dummy_start_timestamp_offset = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.RTPMungerState rtp_munger = 6;</code>
     * @return \Livekit\RTPMungerState|null
     */
    public function getRtpMunger()
    {
        return $this->rtp_munger;
    }

    public function hasRtpMunger()
    {
        return isset($this->rtp_munger);
    }

    public function clearRtpMunger()
    {
        unset($this->rtp_munger);
    }

    /**
     * Generated from protobuf field <code>.livekit.RTPMungerState rtp_munger = 6;</code>
     * @param \Livekit\RTPMungerState $var
     * @return $this
     */
    public function setRtpMunger($var)
    {
        GPBUtil::checkMessage($var, \Livekit\RTPMungerState::class);
        $this->rtp_munger = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.VP8MungerState vp8_munger = 7;</code>
     * @return \Livekit\VP8MungerState|null
     */
    public function getVp8Munger()
    {
        return $this->readOneof(7);
    }

    public function hasVp8Munger()
    {
        return $this->hasOneof(7);
    }

    /**
     * Generated from protobuf field <code>.livekit.VP8MungerState vp8_munger = 7;</code>
     * @param \Livekit\VP8MungerState $var
     * @return $this
     */
    public function setVp8Munger($var)
    {
        GPBUtil::checkMessage($var, \Livekit\VP8MungerState::class);
        $this->writeOneof(7, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.RTCPSenderReportState sender_report_state = 8;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSenderReportState()
    {
        return $this->sender_report_state;
    }

    /**
     * Generated from protobuf field <code>repeated .livekit.RTCPSenderReportState sender_report_state = 8;</code>
     * @param \Livekit\RTCPSenderReportState[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSenderReportState($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Livekit\RTCPSenderReportState::class);
        $this->sender_report_state = $arr;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodecMunger()
    {
        return $this->whichOneof("codec_munger");
    }

}
