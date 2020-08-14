<?php

namespace App\Admin\Repositories;

use App\Models\BandwidthStatistic as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BandwidthStatistic extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
