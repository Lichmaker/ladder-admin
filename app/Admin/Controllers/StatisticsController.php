<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BandwidthStatistic;
use App\Components\V2RayClientManager;
use Dcat\Admin\Admin;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends AdminController
{
    public function my()
    {
        return \Admin::content(function (Content $content) {
            $content->row(function (Row $row) {
                $row->column(12, Grid::make(new BandwidthStatistic(), function (Grid $grid) {
                    $email = Admin::user()->name;
                    logger()->info($email);

                    $grid->model()
                        ->where('email', '=', $email)
                        ->orderBy('id', 'DESC');

                    $grid->disableActions();
                    $grid->disableBatchActions();
                    $grid->disableCreateButton(true);


                    $grid->email;
                    $grid->month('月份');
                    $grid->usage('已用量')->display(function ($usage) {
                        // MB 转成 byte ，然后转成可读值
                        return convertToReadableSize($usage);
                    })->sortable();
                    $grid->max_usage('总可用量(MB)');
                    $grid->column('progress', '使用进度')->display(function () {
                        if ($this->max_usage > 0) {
                            return round($this->usage / $this->max_usage, 4) * 100;
                        } else {
                            return 0;
                        }
                    })->progressBar();


                    $grid->filter(function (Grid\Filter $filter) {
                        $filter->panel();
                        $filter->date('month', '月份')->datetime(['format' => 'YYYY-MM-01']);
                    });
                }));
            });
        });
    }
}
