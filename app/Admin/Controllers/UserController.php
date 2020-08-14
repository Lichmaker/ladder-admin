<?php

namespace App\Admin\Controllers;

use App\Components\V2RayClientManager;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;

class UserController extends \Dcat\Admin\Controllers\UserController
{
    public function store()
    {
        return $this->form()->saved(function (Form $form, $id) {
            // 创建 v2ray 用户
            try {
                $email = request()->post('username');
                V2RayClientManager::createClientWithAdminUserId($id, $email);
            } catch (\Exception $exception) {
                logger()->error('创建v2ray client失败 ： '.$exception->getMessage().$exception->getTraceAsString());
            }
        })->store();
    }
}
