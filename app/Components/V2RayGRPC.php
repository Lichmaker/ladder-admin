<?php

namespace App\Components;

use App\TraitLib\Singleton;
use App\V2ray\Core\App\Stats\Command\GetStatsRequest;
use App\V2ray\Core\App\Stats\Command\StatsServiceClient;
use Exception;

class V2RayGRPC
{
    use Singleton;

    protected $client;

    protected function __construct()
    {
        $host = config('v2ray.grpc_host');
        $this->client = new StatsServiceClient($host, ['credentials' => \Grpc\ChannelCredentials::createInsecure()]);
    }

    /**
     * 根据邮箱，读取流量统计数据
     * 返回结构示例
     * [
        "stat" => [
            "name" => "user>>>test-liuliang@wuguozhang.com>>>traffic>>>downlink",
            "value" => "28639771480",
            ],
        ]
     *
     * @param string $email
     * @param bool $reset
     * @return array
     * @throws Exception
     */
    public function getStatsByEmail(string $email, bool $reset = false)
    {
        $request = new GetStatsRequest();
        // user>>>test-liuliang@wuguozhang.com>>>traffic>>>downlink
        $request->setName("user>>>{$email}>>>traffic>>>downlink")->setReset($reset);
        $call = $this->client->GetStats($request);
        list($reply, $status) = $call->wait();
        if (!$reply) {
            // 记录log， 返回0
            logger()->warning(__METHOD__. ' 无法获取reply : '.json_encode($status));
            return [
                "stat" => [
                    "name" => "user>>>{$email}>>>traffic>>>downlink",
                    "value" => "0",
                ],
            ];
        }
        return json_decode($reply->serializeToJsonString(), true);
    }
}
