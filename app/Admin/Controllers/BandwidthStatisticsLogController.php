<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BandwidthStatisticsLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class BandwidthStatisticsLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BandwidthStatisticsLog(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->email;
            $grid->usage;
            $grid->last_timestamp;
            $grid->created_at;
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new BandwidthStatisticsLog(), function (Show $show) {
            $show->id;
            $show->email;
            $show->usage;
            $show->last_timestamp;
            $show->created_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new BandwidthStatisticsLog(), function (Form $form) {
            $form->display('id');
            $form->text('email');
            $form->text('usage');
            $form->text('last_timestamp');
            $form->text('created_at');
        });
    }
}
