<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AdminArticle;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class AdminArticleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AdminArticle(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->content;
            $grid->tag;
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
        return Show::make($id, new AdminArticle(), function (Show $show) {
            $show->id;
            $show->content;
            $show->tag;
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
        return Form::make(new AdminArticle(), function (Form $form) {
            $form->display('id');
            $form->textarea('content');
            $form->text('tag');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
