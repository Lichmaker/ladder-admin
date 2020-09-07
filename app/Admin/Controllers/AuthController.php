<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Controllers\AuthController as BaseAuthController;
use Dcat\Admin\Form;
use Dcat\Admin\Models\Repositories\Administrator;

class AuthController extends BaseAuthController
{
    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $form = new Form(new Administrator());

        $form->action(admin_url('auth/setting'));

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        $form->display('username', trans('admin.username'));
        $form->display('name', trans('admin.name'));    // 调整name为不可修改
        $form->image('avatar', trans('admin.avatar'));

        $form->password('old_password', trans('admin.old_password'));

        $form->password('password', trans('admin.password'))
            ->minLength(5)
            ->maxLength(20)
            ->customFormat(function ($v) {
                if ($v == $this->password) {
                    return;
                }

                return $v;
            });
        $form->password('password_confirmation', trans('admin.password_confirmation'))->same('password');

        $form->ignore(['password_confirmation', 'old_password']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }

            if (! $form->password) {
                $form->deleteInput('password');
            }
        });

        $form->saved(function (Form $form) {
            return $form->redirect(
                admin_url('auth/setting'),
                trans('admin.update_succeeded')
            );
        });

        return $form;
    }
}
