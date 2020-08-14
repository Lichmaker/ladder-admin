<?php
// GENERATED CODE -- DO NOT EDIT!

namespace V2ray\Core\App\Stats\Command;

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
     * @param \V2ray\Core\App\Stats\Command\GetStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \V2ray\Core\App\Stats\Command\GetStatsResponse
     */
    public function GetStats(\V2ray\Core\App\Stats\Command\GetStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/GetStats',
        $argument,
        ['\V2ray\Core\App\Stats\Command\GetStatsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \V2ray\Core\App\Stats\Command\QueryStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \V2ray\Core\App\Stats\Command\QueryStatsResponse
     */
    public function QueryStats(\V2ray\Core\App\Stats\Command\QueryStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/QueryStats',
        $argument,
        ['\V2ray\Core\App\Stats\Command\QueryStatsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \V2ray\Core\App\Stats\Command\SysStatsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \V2ray\Core\App\Stats\Command\SysStatsResponse
     */
    public function GetSysStats(\V2ray\Core\App\Stats\Command\SysStatsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/v2ray.core.app.stats.command.StatsService/GetSysStats',
        $argument,
        ['\V2ray\Core\App\Stats\Command\SysStatsResponse', 'decode'],
        $metadata, $options);
    }

}
