<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.TrackType</code>
 */
class TrackType
{
    /**
     * Generated from protobuf enum <code>AUDIO = 0;</code>
     */
    const AUDIO = 0;
    /**
     * Generated from protobuf enum <code>VIDEO = 1;</code>
     */
    const VIDEO = 1;
    /**
     * Generated from protobuf enum <code>DATA = 2;</code>
     */
    const DATA = 2;

    private static $valueToName = [
        self::AUDIO => 'AUDIO',
        self::VIDEO => 'VIDEO',
        self::DATA => 'DATA',
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

