<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BandwidthStatistic;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class BandwidthStatisticController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BandwidthStatistic(), function (Grid $grid) {
//            $grid->disableCreateButton(true);
//            $grid->disableDeleteButton(true);
//            $grid->disableBatchDelete(true);

//            $grid->id->sortable();
            $grid->email;
            $grid->month('月份');
            $grid->usage('已用量')->display(function ($usage) {
                // MB 转成 byte ，然后转成可读值
                return convertToReadableSize($usage * pow(1024,2));
            })->sortable();
            $grid->max_usage('总可用量(MB)');
            $grid->created_at;
            $grid->updated_at->sortable();



            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();

                $filter->date('month', '月份')->datetime(['format' => 'YYYY-MM-01']);
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
        return Show::make($id, new BandwidthStatistic(), function (Show $show) {
            $show->id;
            $show->email;
            $show->month;
            $show->usage;
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
        return Form::make(new BandwidthStatistic(), function (Form $form) {
            $form->display('id');
            $form->text('email')->disable();
            $form->text('month')->disable();
            $form->text('usage');

            $form->display('created_at')->disable();
            $form->display('updated_at');
        });
    }
}
