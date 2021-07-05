<?php

namespace App\Jobs;

use App\Components\BandwidthStatisticsSummaryHandler;
use App\Components\V2RayClientManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckClientBandwidth implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 本月数据
        $currentModel = BandwidthStatisticsSummaryHandler::getInstance()->getModel($this->email);
        if (empty($currentModel)) {
            return;
        }

        $maxMB  = $currentModel->max_usage;
        if ($maxMB < 0) {
            // 无限流量
            return;
        }

        $maxByte = $maxMB * 1024 * 1024;
        if ($currentModel->usage >= $maxByte) {
            // 冻结账号
            $clientModel = V2RayClientManager::getClientByEmail($this->email);
            if (empty($clientModel)) {
                logger()->warning(__METHOD__.':找不到数据。'.$this->email);
            }
            V2RayClientManager::freezeClient($clientModel);
        }
    }
}
