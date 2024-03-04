<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_analytics.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.StreamType</code>
 */
class StreamType
{
    /**
     * Generated from protobuf enum <code>UPSTREAM = 0;</code>
     */
    const UPSTREAM = 0;
    /**
     * Generated from protobuf enum <code>DOWNSTREAM = 1;</code>
     */
    const DOWNSTREAM = 1;

    private static $valueToName = [
        self::UPSTREAM => 'UPSTREAM',
        self::DOWNSTREAM => 'DOWNSTREAM',
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
