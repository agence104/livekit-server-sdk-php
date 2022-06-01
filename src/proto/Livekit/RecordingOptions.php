<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_recording.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.RecordingOptions</code>
 */
class RecordingOptions extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.livekit.RecordingPreset preset = 1;</code>
     */
    protected $preset = 0;
    /**
     * default 1920
     *
     * Generated from protobuf field <code>int32 width = 2;</code>
     */
    protected $width = 0;
    /**
     * default 1080
     *
     * Generated from protobuf field <code>int32 height = 3;</code>
     */
    protected $height = 0;
    /**
     * default 24
     *
     * Generated from protobuf field <code>int32 depth = 4;</code>
     */
    protected $depth = 0;
    /**
     * default 30
     *
     * Generated from protobuf field <code>int32 framerate = 5;</code>
     */
    protected $framerate = 0;
    /**
     * default 128
     *
     * Generated from protobuf field <code>int32 audio_bitrate = 6;</code>
     */
    protected $audio_bitrate = 0;
    /**
     * default 44100
     *
     * Generated from protobuf field <code>int32 audio_frequency = 7;</code>
     */
    protected $audio_frequency = 0;
    /**
     * default 4500
     *
     * Generated from protobuf field <code>int32 video_bitrate = 8;</code>
     */
    protected $video_bitrate = 0;
    /**
     * baseline, main, or high. default main
     *
     * Generated from protobuf field <code>string profile = 9;</code>
     */
    protected $profile = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $preset
     *     @type int $width
     *           default 1920
     *     @type int $height
     *           default 1080
     *     @type int $depth
     *           default 24
     *     @type int $framerate
     *           default 30
     *     @type int $audio_bitrate
     *           default 128
     *     @type int $audio_frequency
     *           default 44100
     *     @type int $video_bitrate
     *           default 4500
     *     @type string $profile
     *           baseline, main, or high. default main
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitRecording::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.livekit.RecordingPreset preset = 1;</code>
     * @return int
     */
    public function getPreset()
    {
        return $this->preset;
    }

    /**
     * Generated from protobuf field <code>.livekit.RecordingPreset preset = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPreset($var)
    {
        GPBUtil::checkEnum($var, \Livekit\RecordingPreset::class);
        $this->preset = $var;

        return $this;
    }

    /**
     * default 1920
     *
     * Generated from protobuf field <code>int32 width = 2;</code>
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * default 1920
     *
     * Generated from protobuf field <code>int32 width = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setWidth($var)
    {
        GPBUtil::checkInt32($var);
        $this->width = $var;

        return $this;
    }

    /**
     * default 1080
     *
     * Generated from protobuf field <code>int32 height = 3;</code>
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * default 1080
     *
     * Generated from protobuf field <code>int32 height = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setHeight($var)
    {
        GPBUtil::checkInt32($var);
        $this->height = $var;

        return $this;
    }

    /**
     * default 24
     *
     * Generated from protobuf field <code>int32 depth = 4;</code>
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * default 24
     *
     * Generated from protobuf field <code>int32 depth = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setDepth($var)
    {
        GPBUtil::checkInt32($var);
        $this->depth = $var;

        return $this;
    }

    /**
     * default 30
     *
     * Generated from protobuf field <code>int32 framerate = 5;</code>
     * @return int
     */
    public function getFramerate()
    {
        return $this->framerate;
    }

    /**
     * default 30
     *
     * Generated from protobuf field <code>int32 framerate = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setFramerate($var)
    {
        GPBUtil::checkInt32($var);
        $this->framerate = $var;

        return $this;
    }

    /**
     * default 128
     *
     * Generated from protobuf field <code>int32 audio_bitrate = 6;</code>
     * @return int
     */
    public function getAudioBitrate()
    {
        return $this->audio_bitrate;
    }

    /**
     * default 128
     *
     * Generated from protobuf field <code>int32 audio_bitrate = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setAudioBitrate($var)
    {
        GPBUtil::checkInt32($var);
        $this->audio_bitrate = $var;

        return $this;
    }

    /**
     * default 44100
     *
     * Generated from protobuf field <code>int32 audio_frequency = 7;</code>
     * @return int
     */
    public function getAudioFrequency()
    {
        return $this->audio_frequency;
    }

    /**
     * default 44100
     *
     * Generated from protobuf field <code>int32 audio_frequency = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setAudioFrequency($var)
    {
        GPBUtil::checkInt32($var);
        $this->audio_frequency = $var;

        return $this;
    }

    /**
     * default 4500
     *
     * Generated from protobuf field <code>int32 video_bitrate = 8;</code>
     * @return int
     */
    public function getVideoBitrate()
    {
        return $this->video_bitrate;
    }

    /**
     * default 4500
     *
     * Generated from protobuf field <code>int32 video_bitrate = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setVideoBitrate($var)
    {
        GPBUtil::checkInt32($var);
        $this->video_bitrate = $var;

        return $this;
    }

    /**
     * baseline, main, or high. default main
     *
     * Generated from protobuf field <code>string profile = 9;</code>
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * baseline, main, or high. default main
     *
     * Generated from protobuf field <code>string profile = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setProfile($var)
    {
        GPBUtil::checkString($var, True);
        $this->profile = $var;

        return $this;
    }

}
