<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_egress.proto

namespace Livekit;

use UnexpectedValueException;

/**
 * Protobuf type <code>livekit.EncodedFileType</code>
 */
class EncodedFileType
{
    /**
     * file type chosen based on codecs
     *
     * Generated from protobuf enum <code>DEFAULT_FILETYPE = 0;</code>
     */
    const DEFAULT_FILETYPE = 0;
    /**
     * Generated from protobuf enum <code>MP4 = 1;</code>
     */
    const MP4 = 1;
    /**
     * Generated from protobuf enum <code>OGG = 2;</code>
     */
    const OGG = 2;

    private static $valueToName = [
        self::DEFAULT_FILETYPE => 'DEFAULT_FILETYPE',
        self::MP4 => 'MP4',
        self::OGG => 'OGG',
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

