<?php

namespace App\Components;

use App\Admin\Repositories\BandwidthStatistic;
use App\Admin\Repositories\BandwidthStatisticsLog;

class BandwidthStatisticsHandler
{
    protected $email;
    protected $usage;

    public function __construct(string $email, int $usage)
    {
        $this->email = $email;
        $this->usage = $usage;
        logger()->info(__METHOD__ . json_encode(compact('email', 'usage')));
    }
    public function stat()
    {
        // 写入单条记录
        try {
            $this->writeLog();
        } catch (\Exception $exception) {
            logger()->error(__METHOD__.__LINE__ . ' 异常 '.$exception->getMessage().$exception->getTraceAsString());
        }

        // 写入当月汇总
        try {
            $this->summary();
        } catch (\Exception $exception) {
            logger()->error(__METHOD__.__LINE__ . ' 异常 '.$exception->getMessage().$exception->getTraceAsString());
        }
    }

    protected function summary()
    {
        BandwidthStatisticsSummaryHandler::getInstance()->collect($this->email, $this->usage);
    }

    protected function writeLog()
    {
        // 直接写库
        return BandwidthStatisticsLog::make()->createEloquent([
            'email' => $this->email,
            'usage' => $this->usage,
            'last_timestamp' => V2RayClientManager::getLastStatTimestamp($this->email),
        ])->save();
    }
}
