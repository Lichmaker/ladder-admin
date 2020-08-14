<?php

namespace App\Admin\Repositories;

use App\Models\BandwidthStatisticsLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BandwidthStatisticsLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
