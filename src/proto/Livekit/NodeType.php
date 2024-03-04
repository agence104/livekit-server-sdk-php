<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_internal.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.NodeType</code>
 */
class NodeType
{
    /**
     * Generated from protobuf enum <code>SERVER = 0;</code>
     */
    const SERVER = 0;
    /**
     * Generated from protobuf enum <code>CONTROLLER = 1;</code>
     */
    const CONTROLLER = 1;
    /**
     * Generated from protobuf enum <code>MEDIA = 2;</code>
     */
    const MEDIA = 2;
    /**
     * Generated from protobuf enum <code>TURN = 4;</code>
     */
    const TURN = 4;
    /**
     * Generated from protobuf enum <code>SWEEPER = 5;</code>
     */
    const SWEEPER = 5;
    /**
     * Generated from protobuf enum <code>DIRECTOR = 6;</code>
     */
    const DIRECTOR = 6;

    private static $valueToName = [
        self::SERVER => 'SERVER',
        self::CONTROLLER => 'CONTROLLER',
        self::MEDIA => 'MEDIA',
        self::TURN => 'TURN',
        self::SWEEPER => 'SWEEPER',
        self::DIRECTOR => 'DIRECTOR',
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
