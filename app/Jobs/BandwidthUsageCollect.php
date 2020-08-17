<?php

namespace App\Jobs;

use App\Components\BandwidthStatisticsHandler;
use App\Components\V2RayGRPC;
use App\Models\V2RayClientAttribute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BandwidthUsageCollect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 遍历所有邮箱进行统计
        foreach (V2RayClientAttribute::all() as $model) {
            $byte = V2RayGRPC::getInstance()->getStatsByEmail($model->email, true)['stat']['value'];
            $stat = new BandwidthStatisticsHandler($model->email, $byte);
            $stat->stat();
            logger()->info(__METHOD__ . ' 统计完成， byte : '.$byte.' ; email : '.$model->email);
        }
    }
}
