<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_rtc.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.CandidateProtocol</code>
 */
class CandidateProtocol
{
    /**
     * Generated from protobuf enum <code>UDP = 0;</code>
     */
    const UDP = 0;
    /**
     * Generated from protobuf enum <code>TCP = 1;</code>
     */
    const TCP = 1;
    /**
     * Generated from protobuf enum <code>TLS = 2;</code>
     */
    const TLS = 2;

    private static $valueToName = [
        self::UDP => 'UDP',
        self::TCP => 'TCP',
        self::TLS => 'TLS',
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
