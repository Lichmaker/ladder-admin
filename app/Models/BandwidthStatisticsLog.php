<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class BandwidthStatisticsLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'bandwidth_statistics_log';
    public $timestamps = false;

}
