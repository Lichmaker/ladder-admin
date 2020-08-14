<?php

namespace App\Admin\Repositories;

use App\Components\V2RayServiceProvider;
use App\Models\V2RayClientAttribute as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class V2RayClientAttribute extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
