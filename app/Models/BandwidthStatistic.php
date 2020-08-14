<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class BandwidthStatistic extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'bandwidth_statistics';
    
}
