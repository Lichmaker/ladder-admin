<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\AdminArticle as AdminArticleModel;

class AdminArticle extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = AdminArticleModel::class;

    public static function getAnnouncementContent()
    {
        $model = AdminArticleModel::query()->where('tag', '=','announcement')->first();
        if (empty($model)) {
            return 'undefined';
        } else {
            return \Parsedown::instance()->text($model->content);
        }
    }

    public static function getHelperHomepageContent()
    {
        $model = AdminArticleModel::query()->where('tag', '=','helperHomepage')->first();
        if (empty($model)) {
            return 'undefined';
        } else {
            return \Parsedown::instance()->text($model->content);
        }
    }
}
