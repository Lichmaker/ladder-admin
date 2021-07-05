<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class DataSummary extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'data_summary';
    
}
