<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\ApplyV2RayConfig;
use App\Admin\Actions\Form\EditV2RayConfig;
use App\Admin\Actions\RestartV2Ray;
use App\Admin\Actions\Show\TestAnything;
use App\Admin\Actions\ShowV2RayConfig;
use App\Admin\Actions\UpdateV2RayConfig;
use App\Components\V2RayServiceProvider;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Illuminate\Http\Request;

class V2RayController extends AdminController
{
    public function dashboard(Request $request)
    {
        return \Admin::content(function (Content $content) {
            $content->row(function (Row $row) {
                $row->column(12, '<h2>配置管理</h2>');
            });
            $content->row(function (Row $row) {
                $row->column(2, UpdateV2RayConfig::make());
                $row->column(2, ShowV2RayConfig::make('v2ray配置预览(文件)', ['fromDb' => 0]));
                $row->column(2, ShowV2RayConfig::make('v2ray配置预览(DB)', ['fromDb' => 1]));
                $row->column(2, EditV2RayConfig::make());
                $row->column(2, ApplyV2RayConfig::make());
            });

            $content->row(function (Row $row) {
                $row->column(12, '<HR>');
            });

            $content->row(function (Row $row) {
                $row->column(12, '<h2>程序管理</h2>');
            });
            $content->row(function (Row $row) {
                $row->column(2, RestartV2Ray::make());
            });

            $content->row(function (Row $row) {
                $row->column(12, '<HR>');
            });

            $content->row(function (Row $row) {
                $row->column(12, '<h2>Develop</h2>');
            });
            $content->row(function (Row $row) {
                $row->column(2, TestAnything::make());
            });
        });
    }

    public function updateConfiguration(Request $request)
    {
        $column = $request->post('column');
        $value = $request->post('value');

        if (empty($column) || empty($value)) {
            admin_error('参数错误');
            return back();
        }

        try {
            V2RayServiceProvider::getInstance()->updateConfiguration($column, $value);
        } catch (\Exception $exception) {
            admin_error('捕捉异常 ： '.$exception->getMessage());
            return back();
        }

        admin_success('成功');
        return back();
    }
}
