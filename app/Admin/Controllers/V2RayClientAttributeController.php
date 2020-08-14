<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\V2RayClientAttribute;
use chillerlan\QRCode\QRCode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class V2RayClientAttributeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new V2RayClientAttribute(), function (Grid $grid) {
            $grid->admin_user_id->sortable();
            $grid->expire_at;
            $grid->uuid;
//            $grid->column('v2ray_qrcode', '二维码')->qrcode(function () {
//                $qrCode = new QRCode();
//                return $qrCode->render($this->v2ray_vmess);
////                return 'wuguozhang-blog.oss-cn-shenzhen.aliyuncs.com/vps/tokyo_qrcode.png';
//            });
//            $grid->v2ray_qrcode('二维码')->qrcode(function () {
//                return $this->v2ray_qrcode;
//            });
            $grid->column('v2ray_qrcode', '二维码')->display(function () {
                $qrCode = new QRCode();
                return $qrCode->render($this->v2ray_vmess);
            })->view('qrcode');
            $grid->v2ray_vmess;
            $grid->created_at;
            $grid->email;
            $grid->bandwidth_usage_max;
            $grid->updated_at->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('admin_user_id');
                $filter->equal('email');
            });

            $grid->disableCreateButton();   // 不允许直接创建
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
        return Show::make($id, new V2RayClientAttribute(), function (Show $show) {
            $show->admin_user_id;
            $show->expire_at;
            $show->uuid;
            $show->v2ray_vmess;
            $show->created_at;
            $show->updated_at;
            $show->email;
            $show->bandwidth_usage_max;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new V2RayClientAttribute(), function (Form $form) {
            $form->display('admin_user_id');
            $form->text('expire_at');
            $form->text('uuid');
//            $form->text('v2ray_qrcode');
            $form->text('v2ray_vmess');
            $form->text('email');
            $form->text('bandwidth_usage_max');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
