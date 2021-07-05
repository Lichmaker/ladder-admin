<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\DataSummary;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DataSummaryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DataSummary(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->date;
            $grid->downlink_byte;
            $grid->uplink_byte;
            $grid->username;
            $grid->created_at;
            $grid->updated_at->sortable();
        
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
        return Show::make($id, new DataSummary(), function (Show $show) {
            $show->id;
            $show->date;
            $show->downlink_byte;
            $show->uplink_byte;
            $show->username;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new DataSummary(), function (Form $form) {
            $form->display('id');
            $form->text('date');
            $form->text('downlink_byte');
            $form->text('uplink_byte');
            $form->text('username');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
