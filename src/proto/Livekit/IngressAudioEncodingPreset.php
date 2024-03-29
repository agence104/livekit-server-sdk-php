<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_ingress.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.IngressAudioEncodingPreset</code>
 */
class IngressAudioEncodingPreset
{
    /**
     * OPUS, 2 channels, 96kbps
     *
     * Generated from protobuf enum <code>OPUS_STEREO_96KBPS = 0;</code>
     */
    const OPUS_STEREO_96KBPS = 0;
    /**
     * OPUS, 1 channel, 64kbps
     *
     * Generated from protobuf enum <code>OPUS_MONO_64KBS = 1;</code>
     */
    const OPUS_MONO_64KBS = 1;

    private static $valueToName = [
        self::OPUS_STEREO_96KBPS => 'OPUS_STEREO_96KBPS',
        self::OPUS_MONO_64KBS => 'OPUS_MONO_64KBS',
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

