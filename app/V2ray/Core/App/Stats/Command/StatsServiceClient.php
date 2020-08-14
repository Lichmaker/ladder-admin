<?php
// GENERATED CODE -- DO NOT EDIT!

namespace App\V2ray\Core\App\Stats\Command;

/**
 */
class StatsServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \App\V2ray\Core\App\Stats\Command\GetStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \App\V2ray\Core\App\Stats\Command\GetStatsResponse
     */
    public function GetStats(\App\V2ray\Core\App\Stats\Command\GetStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/GetStats',
        $argument,
        ['\App\V2ray\Core\App\Stats\Command\GetStatsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \App\V2ray\Core\App\Stats\Command\QueryStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \App\V2ray\Core\App\Stats\Command\QueryStatsResponse
     */
    public function QueryStats(\App\V2ray\Core\App\Stats\Command\QueryStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/QueryStats',
        $argument,
        ['\App\V2ray\Core\App\Stats\Command\QueryStatsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \App\V2ray\Core\App\Stats\Command\SysStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \App\V2ray\Core\App\Stats\Command\SysStatsResponse
     */
    public function GetSysStats(\App\V2ray\Core\App\Stats\Command\SysStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/GetSysStats',
        $argument,
        ['\App\V2ray\Core\App\Stats\Command\SysStatsResponse', 'decode'],
        $metadata, $options);
    }

}
