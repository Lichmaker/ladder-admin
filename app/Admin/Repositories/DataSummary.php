<?php

namespace App\Admin\Repositories;

use App\Models\DataSummary as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DataSummary extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
