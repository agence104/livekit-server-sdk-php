<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_metrics.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * index from [0: MAX_LABEL_PREDEFINED_MAX_VALUE) are for predefined labels (`MetricLabel`)
 *
 * Protobuf type <code>livekit.MetricLabel</code>
 */
class MetricLabel
{
    /**
     * time to first token from LLM
     *
     * Generated from protobuf enum <code>AGENTS_LLM_TTFT = 0;</code>
     */
    const AGENTS_LLM_TTFT = 0;
    /**
     * time to final transcription
     *
     * Generated from protobuf enum <code>AGENTS_STT_TTFT = 1;</code>
     */
    const AGENTS_STT_TTFT = 1;
    /**
     * time to first byte
     *
     * Generated from protobuf enum <code>AGENTS_TTS_TTFB = 2;</code>
     */
    const AGENTS_TTS_TTFB = 2;
    /**
     * Number of video freezes
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_SUBSCRIBER_FREEZE_COUNT = 3;</code>
     */
    const CLIENT_VIDEO_SUBSCRIBER_FREEZE_COUNT = 3;
    /**
     * total duration of freezes
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_SUBSCRIBER_TOTAL_FREEZE_DURATION = 4;</code>
     */
    const CLIENT_VIDEO_SUBSCRIBER_TOTAL_FREEZE_DURATION = 4;
    /**
     * number of video pauses
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_SUBSCRIBER_PAUSE_COUNT = 5;</code>
     */
    const CLIENT_VIDEO_SUBSCRIBER_PAUSE_COUNT = 5;
    /**
     * total duration of pauses
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_SUBSCRIBER_TOTAL_PAUSES_DURATION = 6;</code>
     */
    const CLIENT_VIDEO_SUBSCRIBER_TOTAL_PAUSES_DURATION = 6;
    /**
     * number of concealed (synthesized) audio samples
     *
     * Generated from protobuf enum <code>CLIENT_AUDIO_SUBSCRIBER_CONCEALED_SAMPLES = 7;</code>
     */
    const CLIENT_AUDIO_SUBSCRIBER_CONCEALED_SAMPLES = 7;
    /**
     * number of silent concealed samples
     *
     * Generated from protobuf enum <code>CLIENT_AUDIO_SUBSCRIBER_SILENT_CONCEALED_SAMPLES = 8;</code>
     */
    const CLIENT_AUDIO_SUBSCRIBER_SILENT_CONCEALED_SAMPLES = 8;
    /**
     * number of concealment events
     *
     * Generated from protobuf enum <code>CLIENT_AUDIO_SUBSCRIBER_CONCEALMENT_EVENTS = 9;</code>
     */
    const CLIENT_AUDIO_SUBSCRIBER_CONCEALMENT_EVENTS = 9;
    /**
     * number of interruptions
     *
     * Generated from protobuf enum <code>CLIENT_AUDIO_SUBSCRIBER_INTERRUPTION_COUNT = 10;</code>
     */
    const CLIENT_AUDIO_SUBSCRIBER_INTERRUPTION_COUNT = 10;
    /**
     * total duration of interruptions
     *
     * Generated from protobuf enum <code>CLIENT_AUDIO_SUBSCRIBER_TOTAL_INTERRUPTION_DURATION = 11;</code>
     */
    const CLIENT_AUDIO_SUBSCRIBER_TOTAL_INTERRUPTION_DURATION = 11;
    /**
     * total time spent in jitter buffer
     *
     * Generated from protobuf enum <code>CLIENT_SUBSCRIBER_JITTER_BUFFER_DELAY = 12;</code>
     */
    const CLIENT_SUBSCRIBER_JITTER_BUFFER_DELAY = 12;
    /**
     * total time spent in jitter buffer
     *
     * Generated from protobuf enum <code>CLIENT_SUBSCRIBER_JITTER_BUFFER_EMITTED_COUNT = 13;</code>
     */
    const CLIENT_SUBSCRIBER_JITTER_BUFFER_EMITTED_COUNT = 13;
    /**
     * total duration spent in bandwidth quality limitation
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_BANDWIDTH = 14;</code>
     */
    const CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_BANDWIDTH = 14;
    /**
     * total duration spent in cpu quality limitation
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_CPU = 15;</code>
     */
    const CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_CPU = 15;
    /**
     * total duration spent in other quality limitation
     *
     * Generated from protobuf enum <code>CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_OTHER = 16;</code>
     */
    const CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_OTHER = 16;
    /**
     * Generated from protobuf enum <code>METRIC_LABEL_PREDEFINED_MAX_VALUE = 4096;</code>
     */
    const METRIC_LABEL_PREDEFINED_MAX_VALUE = 4096;

    private static $valueToName = [
        self::AGENTS_LLM_TTFT => 'AGENTS_LLM_TTFT',
        self::AGENTS_STT_TTFT => 'AGENTS_STT_TTFT',
        self::AGENTS_TTS_TTFB => 'AGENTS_TTS_TTFB',
        self::CLIENT_VIDEO_SUBSCRIBER_FREEZE_COUNT => 'CLIENT_VIDEO_SUBSCRIBER_FREEZE_COUNT',
        self::CLIENT_VIDEO_SUBSCRIBER_TOTAL_FREEZE_DURATION => 'CLIENT_VIDEO_SUBSCRIBER_TOTAL_FREEZE_DURATION',
        self::CLIENT_VIDEO_SUBSCRIBER_PAUSE_COUNT => 'CLIENT_VIDEO_SUBSCRIBER_PAUSE_COUNT',
        self::CLIENT_VIDEO_SUBSCRIBER_TOTAL_PAUSES_DURATION => 'CLIENT_VIDEO_SUBSCRIBER_TOTAL_PAUSES_DURATION',
        self::CLIENT_AUDIO_SUBSCRIBER_CONCEALED_SAMPLES => 'CLIENT_AUDIO_SUBSCRIBER_CONCEALED_SAMPLES',
        self::CLIENT_AUDIO_SUBSCRIBER_SILENT_CONCEALED_SAMPLES => 'CLIENT_AUDIO_SUBSCRIBER_SILENT_CONCEALED_SAMPLES',
        self::CLIENT_AUDIO_SUBSCRIBER_CONCEALMENT_EVENTS => 'CLIENT_AUDIO_SUBSCRIBER_CONCEALMENT_EVENTS',
        self::CLIENT_AUDIO_SUBSCRIBER_INTERRUPTION_COUNT => 'CLIENT_AUDIO_SUBSCRIBER_INTERRUPTION_COUNT',
        self::CLIENT_AUDIO_SUBSCRIBER_TOTAL_INTERRUPTION_DURATION => 'CLIENT_AUDIO_SUBSCRIBER_TOTAL_INTERRUPTION_DURATION',
        self::CLIENT_SUBSCRIBER_JITTER_BUFFER_DELAY => 'CLIENT_SUBSCRIBER_JITTER_BUFFER_DELAY',
        self::CLIENT_SUBSCRIBER_JITTER_BUFFER_EMITTED_COUNT => 'CLIENT_SUBSCRIBER_JITTER_BUFFER_EMITTED_COUNT',
        self::CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_BANDWIDTH => 'CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_BANDWIDTH',
        self::CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_CPU => 'CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_CPU',
        self::CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_OTHER => 'CLIENT_VIDEO_PUBLISHER_QUALITY_LIMITATION_DURATION_OTHER',
        self::METRIC_LABEL_PREDEFINED_MAX_VALUE => 'METRIC_LABEL_PREDEFINED_MAX_VALUE',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}
