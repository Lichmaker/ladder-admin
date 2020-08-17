<?php

namespace App\Components;

use App\Admin\Repositories\BandwidthStatistic;
use App\Exceptions\BandwidthStatisticsException;
use App\TraitLib\Singleton;

class BandwidthStatisticsSummaryHandler
{
    use Singleton;

    protected $resetDate;

    protected function __construct()
    {
        // 流量重制日期
        $this->resetDate = date('Y-m-'.config('bandwidth_reset_date'));
    }

    public function collect(string $email, int $usage)
    {
        $date = $this->getCurrentDate();
        $model = $this->getModel($email, $date);
        $usageMB = round(byteToMB($usage));  // byte转成MB，四舍五入
        logger()->info(__METHOD__ . json_encode(compact('usage', 'usageMB')));
        $model->usage += $usage;
        if (!$model->save()) {
            throw new \Exception(__METHOD__.' save failed . '.json_encode($model->getAttributes(), JSON_UNESCAPED_UNICODE));
        }
        V2RayClientManager::updateLastStatTimestamp($email);
    }

    public function getModel($email, $date = NULL)
    {
        if (!is_string($date)) {
            $date = $this->getCurrentDate();
        }

        $model = BandwidthStatistic::make()->createEloquent()->newQuery()->where([
            'email' => $email,
            'month' => $date,
        ])->first();
        if (empty($model)) {
            $model = BandwidthStatistic::make()->createEloquent([
                'email' => $email,
                'month' => $date,
                'usage' => 0,
            ]);
            if (!$model->save()) {
                throw new \Exception(__METHOD__.' save failed . '.json_encode($model->getAttributes(), JSON_UNESCAPED_UNICODE));
            }
        }
        return $model;
    }

    protected function getCurrentDate()
    {
        if (strtotime($this->resetDate) >= time()) {
            // 计入上个月
            $date = date('Y-m-01', strtotime('last month'));
        } else {
            $date = date('Y-m-01');
        }
        return $date;
    }
}
