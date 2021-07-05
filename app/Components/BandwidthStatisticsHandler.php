<?php

namespace App\Components;

use App\Admin\Repositories\BandwidthStatistic;
use App\Admin\Repositories\BandwidthStatisticsLog;
use App\Jobs\CheckClientBandwidth;

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
        if ($this->usage > 0) {
            // 写入当月汇总
            try {
                $this->summary();
            } catch (\Exception $exception) {
                logger()->error(__METHOD__.__LINE__ . ' 异常 '.$exception->getMessage().$exception->getTraceAsString());
            }
        } else {
            logger()->info(__METHOD__ . ' usage 为0，不执行数据库更新');
        }

        // 触发异步流量检查
        CheckClientBandwidth::dispatch($this->email);
    }

    protected function summary()
    {
        BandwidthStatisticsSummaryHandler::getInstance()->update($this->email, $this->usage);
    }
}
