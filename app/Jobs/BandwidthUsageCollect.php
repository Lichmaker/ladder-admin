<?php

namespace App\Jobs;

use App\Admin\Repositories\DataSummary;
use App\Components\BandwidthStatisticsHandler;
use App\Components\BandwidthStatisticsSummaryHandler;
use App\Components\V2RayClientManager;
use App\Components\V2RayGRPC;
use App\Models\V2RayClientAttribute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

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
//        // 读取golang统计数据，写入到表中
        $dateRange = BandwidthStatisticsSummaryHandler::getInstance()->getCurrentDataRange();
        $query = DataSummary::make()->createEloquent()->newQuery()
            ->whereBetween('date', [$dateRange['start'], $dateRange['end']])
            ->groupBy('username')->selectRaw('sum(`uplink_byte`+`downlink_byte`) as byte, username')->get();
        foreach ($query as $row) {
            $stat = new BandwidthStatisticsHandler($row->username, $row->byte);
            $stat->stat();
            logger()->info(__METHOD__ . ' 统计完成， byte : '.$row->byte.' ; email : '.$row->username);
        }
    }
}
