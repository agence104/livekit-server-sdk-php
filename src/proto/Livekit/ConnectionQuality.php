<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.ConnectionQuality</code>
 */
class ConnectionQuality
{
    /**
     * Generated from protobuf enum <code>POOR = 0;</code>
     */
    const POOR = 0;
    /**
     * Generated from protobuf enum <code>GOOD = 1;</code>
     */
    const GOOD = 1;
    /**
     * Generated from protobuf enum <code>EXCELLENT = 2;</code>
     */
    const EXCELLENT = 2;
    /**
     * Generated from protobuf enum <code>LOST = 3;</code>
     */
    const LOST = 3;

    private static $valueToName = [
        self::POOR => 'POOR',
        self::GOOD => 'GOOD',
        self::EXCELLENT => 'EXCELLENT',
        self::LOST => 'LOST',
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

