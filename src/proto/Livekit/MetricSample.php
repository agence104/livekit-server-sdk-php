<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_metrics.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.MetricSample</code>
 */
class MetricSample extends \Google\Protobuf\Internal\Message
{
    /**
     * time of metric based on a monotonic clock (in milliseconds)
     *
     * Generated from protobuf field <code>int64 timestamp_ms = 1;</code>
     */
    protected $timestamp_ms = 0;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp normalized_timestamp = 2;</code>
     */
    protected $normalized_timestamp = null;
    /**
     * Generated from protobuf field <code>float value = 3;</code>
     */
    protected $value = 0.0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $timestamp_ms
     *           time of metric based on a monotonic clock (in milliseconds)
     *     @type \Google\Protobuf\Timestamp $normalized_timestamp
     *     @type float $value
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitMetrics::initOnce();
        parent::__construct($data);
    }

    /**
     * time of metric based on a monotonic clock (in milliseconds)
     *
     * Generated from protobuf field <code>int64 timestamp_ms = 1;</code>
     * @return int|string
     */
    public function getTimestampMs()
    {
        return $this->timestamp_ms;
    }

    /**
     * time of metric based on a monotonic clock (in milliseconds)
     *
     * Generated from protobuf field <code>int64 timestamp_ms = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimestampMs($var)
    {
        GPBUtil::checkInt64($var);
        $this->timestamp_ms = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp normalized_timestamp = 2;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getNormalizedTimestamp()
    {
        return $this->normalized_timestamp;
    }

    public function hasNormalizedTimestamp()
    {
        return isset($this->normalized_timestamp);
    }

    public function clearNormalizedTimestamp()
    {
        unset($this->normalized_timestamp);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp normalized_timestamp = 2;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setNormalizedTimestamp($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->normalized_timestamp = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>float value = 3;</code>
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Generated from protobuf field <code>float value = 3;</code>
     * @param float $var
     * @return $this
     */
    public function setValue($var)
    {
        GPBUtil::checkFloat($var);
        $this->value = $var;

        return $this;
    }

}

