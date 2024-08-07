<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_agent.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * from Worker to Server
 *
 * Generated from protobuf message <code>livekit.WorkerMessage</code>
 */
class WorkerMessage extends \Google\Protobuf\Internal\Message
{
    protected $message;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Livekit\RegisterWorkerRequest $register
     *           agent workers need to register themselves with the server first
     *     @type \Livekit\AvailabilityResponse $availability
     *           worker confirms to server that it's available for a job, or declines it
     *     @type \Livekit\UpdateWorkerStatus $update_worker
     *           worker can update its status to the server, including taking itself out of the pool
     *     @type \Livekit\UpdateJobStatus $update_job
     *           job can send status updates to the server, useful for tracking progress
     *     @type \Livekit\WorkerPing $ping
     *     @type \Livekit\SimulateJobRequest $simulate_job
     *     @type \Livekit\MigrateJobRequest $migrate_job
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitAgent::initOnce();
        parent::__construct($data);
    }

    /**
     * agent workers need to register themselves with the server first
     *
     * Generated from protobuf field <code>.livekit.RegisterWorkerRequest register = 1;</code>
     * @return \Livekit\RegisterWorkerRequest|null
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
     * agent workers need to register themselves with the server first
     *
     * Generated from protobuf field <code>.livekit.RegisterWorkerRequest register = 1;</code>
     * @param \Livekit\RegisterWorkerRequest $var
     * @return $this
     */
    public function setRegister($var)
    {
        GPBUtil::checkMessage($var, \Livekit\RegisterWorkerRequest::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * worker confirms to server that it's available for a job, or declines it
     *
     * Generated from protobuf field <code>.livekit.AvailabilityResponse availability = 2;</code>
     * @return \Livekit\AvailabilityResponse|null
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
     * worker confirms to server that it's available for a job, or declines it
     *
     * Generated from protobuf field <code>.livekit.AvailabilityResponse availability = 2;</code>
     * @param \Livekit\AvailabilityResponse $var
     * @return $this
     */
    public function setAvailability($var)
    {
        GPBUtil::checkMessage($var, \Livekit\AvailabilityResponse::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * worker can update its status to the server, including taking itself out of the pool
     *
     * Generated from protobuf field <code>.livekit.UpdateWorkerStatus update_worker = 3;</code>
     * @return \Livekit\UpdateWorkerStatus|null
     */
    public function getUpdateWorker()
    {
        return $this->readOneof(3);
    }

    public function hasUpdateWorker()
    {
        return $this->hasOneof(3);
    }

    /**
     * worker can update its status to the server, including taking itself out of the pool
     *
     * Generated from protobuf field <code>.livekit.UpdateWorkerStatus update_worker = 3;</code>
     * @param \Livekit\UpdateWorkerStatus $var
     * @return $this
     */
    public function setUpdateWorker($var)
    {
        GPBUtil::checkMessage($var, \Livekit\UpdateWorkerStatus::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * job can send status updates to the server, useful for tracking progress
     *
     * Generated from protobuf field <code>.livekit.UpdateJobStatus update_job = 4;</code>
     * @return \Livekit\UpdateJobStatus|null
     */
    public function getUpdateJob()
    {
        return $this->readOneof(4);
    }

    public function hasUpdateJob()
    {
        return $this->hasOneof(4);
    }

    /**
     * job can send status updates to the server, useful for tracking progress
     *
     * Generated from protobuf field <code>.livekit.UpdateJobStatus update_job = 4;</code>
     * @param \Livekit\UpdateJobStatus $var
     * @return $this
     */
    public function setUpdateJob($var)
    {
        GPBUtil::checkMessage($var, \Livekit\UpdateJobStatus::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.WorkerPing ping = 5;</code>
     * @return \Livekit\WorkerPing|null
     */
    public function getPing()
    {
        return $this->readOneof(5);
    }

    public function hasPing()
    {
        return $this->hasOneof(5);
    }

    /**
     * Generated from protobuf field <code>.livekit.WorkerPing ping = 5;</code>
     * @param \Livekit\WorkerPing $var
     * @return $this
     */
    public function setPing($var)
    {
        GPBUtil::checkMessage($var, \Livekit\WorkerPing::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.SimulateJobRequest simulate_job = 6;</code>
     * @return \Livekit\SimulateJobRequest|null
     */
    public function getSimulateJob()
    {
        return $this->readOneof(6);
    }

    public function hasSimulateJob()
    {
        return $this->hasOneof(6);
    }

    /**
     * Generated from protobuf field <code>.livekit.SimulateJobRequest simulate_job = 6;</code>
     * @param \Livekit\SimulateJobRequest $var
     * @return $this
     */
    public function setSimulateJob($var)
    {
        GPBUtil::checkMessage($var, \Livekit\SimulateJobRequest::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.MigrateJobRequest migrate_job = 7;</code>
     * @return \Livekit\MigrateJobRequest|null
     */
    public function getMigrateJob()
    {
        return $this->readOneof(7);
    }

    public function hasMigrateJob()
    {
        return $this->hasOneof(7);
    }

    /**
     * Generated from protobuf field <code>.livekit.MigrateJobRequest migrate_job = 7;</code>
     * @param \Livekit\MigrateJobRequest $var
     * @return $this
     */
    public function setMigrateJob($var)
    {
        GPBUtil::checkMessage($var, \Livekit\MigrateJobRequest::class);
        $this->writeOneof(7, $var);

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

