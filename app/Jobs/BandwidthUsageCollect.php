<?php

namespace App\Jobs;

use App\Components\BandwidthStatisticsHandler;
use App\Components\V2RayGRPC;
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
        $byte = V2RayGRPC::getInstance()->getStatsByEmail('test-liuliang@wuguozhang.com', true)['stat']['value'];
        $stat = new BandwidthStatisticsHandler('test-liuliang@wuguozhang.com', $byte);
        $stat->stat();
        logger()->info(__METHOD__ . ' 统计完成， byte : '.$byte);
    }
}
