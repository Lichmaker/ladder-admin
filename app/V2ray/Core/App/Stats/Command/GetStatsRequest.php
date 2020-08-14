<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: command.proto

namespace App\V2ray\Core\App\Stats\Command;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>app.v2ray.core.app.stats.command.GetStatsRequest</code>
 */
class GetStatsRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Name of the stat counter.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    protected $name = '';
    /**
     * Whether or not to reset the counter to fetching its value.
     *
     * Generated from protobuf field <code>bool reset = 2;</code>
     */
    protected $reset = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Name of the stat counter.
     *     @type bool $reset
     *           Whether or not to reset the counter to fetching its value.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Command::initOnce();
        parent::__construct($data);
    }

    /**
     * Name of the stat counter.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Name of the stat counter.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Whether or not to reset the counter to fetching its value.
     *
     * Generated from protobuf field <code>bool reset = 2;</code>
     * @return bool
     */
    public function getReset()
    {
        return $this->reset;
    }

    /**
     * Whether or not to reset the counter to fetching its value.
     *
     * Generated from protobuf field <code>bool reset = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setReset($var)
    {
        GPBUtil::checkBool($var);
        $this->reset = $var;

        return $this;
    }

}

