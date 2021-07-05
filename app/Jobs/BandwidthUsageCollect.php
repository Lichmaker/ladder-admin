<?php

namespace App\Jobs;

use App\Admin\Repositories\DataSummary;
use App\Components\BandwidthStatisticsHandler;
use App\Components\V2RayClientManager;
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
        // 读取golang统计数据，写入到表中
        $date = date('Y-m-d');
        $query = DataSummary::make()->createEloquent()->newQuery()->where([
            'date' => $date,
        ])->get();
        foreach ($query as $row) {
            $byte = $row->uplink_byte + $row->downlink_byte;
            $stat = new BandwidthStatisticsHandler($row->username, $byte);
            $stat->stat();
            logger()->info(__METHOD__ . ' 统计完成， byte : '.$byte.' ; email : '.$row->username);
        }
    }
}
