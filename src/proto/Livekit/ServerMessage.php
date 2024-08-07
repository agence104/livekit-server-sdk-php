<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_agent.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * from Server to Worker
 *
 * Generated from protobuf message <code>livekit.ServerMessage</code>
 */
class ServerMessage extends \Google\Protobuf\Internal\Message
{
    protected $message;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\RegisterWorkerResponse $register
     *           server confirms the registration, from this moment on, the worker is considered active
     *     @type \Livekit\AvailabilityRequest $availability
     *           server asks worker to confirm availability for a job
     *     @type \Livekit\JobAssignment $assignment
     *     @type \Livekit\JobTermination $termination
     *     @type \Livekit\WorkerPong $pong
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitAgent::initOnce();
        parent::__construct($data);
    }

    /**
     * server confirms the registration, from this moment on, the worker is considered active
     *
     * Generated from protobuf field <code>.livekit.RegisterWorkerResponse register = 1;</code>
     * @return \Livekit\RegisterWorkerResponse|null
     */
    public function getRegister()
    {
        return $this->readOneof(1);
    }

    public function hasRegister()
    {
        return $this->hasOneof(1);
    }

    /**
     * server confirms the registration, from this moment on, the worker is considered active
     *
     * Generated from protobuf field <code>.livekit.RegisterWorkerResponse register = 1;</code>
     * @param \Livekit\RegisterWorkerResponse $var
     * @return $this
     */
    public function setRegister($var)
    {
        GPBUtil::checkMessage($var, \Livekit\RegisterWorkerResponse::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * server asks worker to confirm availability for a job
     *
     * Generated from protobuf field <code>.livekit.AvailabilityRequest availability = 2;</code>
     * @return \Livekit\AvailabilityRequest|null
     */
    public function getAvailability()
    {
        return $this->readOneof(2);
    }

    public function hasAvailability()
    {
        return $this->hasOneof(2);
    }

    /**
     * server asks worker to confirm availability for a job
     *
     * Generated from protobuf field <code>.livekit.AvailabilityRequest availability = 2;</code>
     * @param \Livekit\AvailabilityRequest $var
     * @return $this
     */
    public function setAvailability($var)
    {
        GPBUtil::checkMessage($var, \Livekit\AvailabilityRequest::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.JobAssignment assignment = 3;</code>
     * @return \Livekit\JobAssignment|null
     */
    public function getAssignment()
    {
        return $this->readOneof(3);
    }

    public function hasAssignment()
    {
        return $this->hasOneof(3);
    }

    /**
     * Generated from protobuf field <code>.livekit.JobAssignment assignment = 3;</code>
     * @param \Livekit\JobAssignment $var
     * @return $this
     */
    public function setAssignment($var)
    {
        GPBUtil::checkMessage($var, \Livekit\JobAssignment::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.JobTermination termination = 5;</code>
     * @return \Livekit\JobTermination|null
     */
    public function getTermination()
    {
        return $this->readOneof(5);
    }

    public function hasTermination()
    {
        return $this->hasOneof(5);
    }

    /**
     * Generated from protobuf field <code>.livekit.JobTermination termination = 5;</code>
     * @param \Livekit\JobTermination $var
     * @return $this
     */
    public function setTermination($var)
    {
        GPBUtil::checkMessage($var, \Livekit\JobTermination::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.WorkerPong pong = 4;</code>
     * @return \Livekit\WorkerPong|null
     */
    public function getPong()
    {
        return $this->readOneof(4);
    }

    public function hasPong()
    {
        return $this->hasOneof(4);
    }

    /**
     * Generated from protobuf field <code>.livekit.WorkerPong pong = 4;</code>
     * @param \Livekit\WorkerPong $var
     * @return $this
     */
    public function setPong($var)
    {
        GPBUtil::checkMessage($var, \Livekit\WorkerPong::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->whichOneof("message");
    }

}

