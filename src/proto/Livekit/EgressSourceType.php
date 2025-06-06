<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_egress.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.EgressSourceType</code>
 */
class EgressSourceType
{
    /**
     * Generated from protobuf enum <code>EGRESS_SOURCE_TYPE_WEB = 0;</code>
     */
    const EGRESS_SOURCE_TYPE_WEB = 0;
    /**
     * Generated from protobuf enum <code>EGRESS_SOURCE_TYPE_SDK = 1;</code>
     */
    const EGRESS_SOURCE_TYPE_SDK = 1;

    private static $valueToName = [
        self::EGRESS_SOURCE_TYPE_WEB => 'EGRESS_SOURCE_TYPE_WEB',
        self::EGRESS_SOURCE_TYPE_SDK => 'EGRESS_SOURCE_TYPE_SDK',
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

