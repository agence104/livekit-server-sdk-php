<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_models.proto

namespace Livekit\DataStream;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.DataStream.Chunk</code>
 */
class Chunk extends \Google\Protobuf\Internal\Message
{
    /**
     * unique identifier for this data stream to map it to the correct header
     *
     * Generated from protobuf field <code>string stream_id = 1;</code>
     */
    protected $stream_id = '';
    /**
     * Generated from protobuf field <code>uint64 chunk_index = 2;</code>
     */
    protected $chunk_index = 0;
    /**
     * content as binary (bytes)
     *
     * Generated from protobuf field <code>bytes content = 3;</code>
     */
    protected $content = '';
    /**
     * a version indicating that this chunk_index has been retroactively modified and the original one needs to be replaced
     *
     * Generated from protobuf field <code>int32 version = 4;</code>
     */
    protected $version = 0;
    /**
     * optional, initialization vector for AES-GCM encryption
     *
     * Generated from protobuf field <code>optional bytes iv = 5;</code>
     */
    protected $iv = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $stream_id
     *           unique identifier for this data stream to map it to the correct header
     *     @type int|string $chunk_index
     *     @type string $content
     *           content as binary (bytes)
     *     @type int $version
     *           a version indicating that this chunk_index has been retroactively modified and the original one needs to be replaced
     *     @type string $iv
     *           optional, initialization vector for AES-GCM encryption
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitModels::initOnce();
        parent::__construct($data);
    }

    /**
     * unique identifier for this data stream to map it to the correct header
     *
     * Generated from protobuf field <code>string stream_id = 1;</code>
     * @return string
     */
    public function getStreamId()
    {
        return $this->stream_id;
    }

    /**
     * unique identifier for this data stream to map it to the correct header
     *
     * Generated from protobuf field <code>string stream_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setStreamId($var)
    {
        GPBUtil::checkString($var, True);
        $this->stream_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint64 chunk_index = 2;</code>
     * @return int|string
     */
    public function getChunkIndex()
    {
        return $this->chunk_index;
    }

    /**
     * Generated from protobuf field <code>uint64 chunk_index = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setChunkIndex($var)
    {
        GPBUtil::checkUint64($var);
        $this->chunk_index = $var;

        return $this;
    }

    /**
     * content as binary (bytes)
     *
     * Generated from protobuf field <code>bytes content = 3;</code>
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * content as binary (bytes)
     *
     * Generated from protobuf field <code>bytes content = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setContent($var)
    {
        GPBUtil::checkString($var, False);
        $this->content = $var;

        return $this;
    }

    /**
     * a version indicating that this chunk_index has been retroactively modified and the original one needs to be replaced
     *
     * Generated from protobuf field <code>int32 version = 4;</code>
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * a version indicating that this chunk_index has been retroactively modified and the original one needs to be replaced
     *
     * Generated from protobuf field <code>int32 version = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkInt32($var);
        $this->version = $var;

        return $this;
    }

    /**
     * optional, initialization vector for AES-GCM encryption
     *
     * Generated from protobuf field <code>optional bytes iv = 5;</code>
     * @return string
     */
    public function getIv()
    {
        return isset($this->iv) ? $this->iv : '';
    }

    public function hasIv()
    {
        return isset($this->iv);
    }

    public function clearIv()
    {
        unset($this->iv);
    }

    /**
     * optional, initialization vector for AES-GCM encryption
     *
     * Generated from protobuf field <code>optional bytes iv = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setIv($var)
    {
        GPBUtil::checkString($var, False);
        $this->iv = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Chunk::class, \Livekit\DataStream_Chunk::class);

