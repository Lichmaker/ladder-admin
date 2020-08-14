<?php

namespace App\Admin\Actions;

use App\Components\V2RayServiceProvider;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApplyV2RayConfig extends Action
{
    /**
     * @return string
     */
    protected $title = 'v2ray配置应用';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        try {
            V2RayServiceProvider::getInstance()->writeConfigIntoFile();
        } catch (\Exception $exception) {
            logger()->error(__METHOD__. " 异常 , msg {$exception->getMessage()} , trace {$exception->getTraceAsString()}");
            return  $this->response()->error('异常  ： '.$exception->getMessage())->refresh();
        }

        return $this->response()->success('写入成功')->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
         return ['确认应用配置?', '确认后会更新/etc/v2ray/config.json ， 需要重启后才能生效'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }

    /**
     * 设置HTML标签的属性
     *
     * @return void
     */
    protected function setupHtmlAttributes()
    {
        // 添加class
        $this->addHtmlClass('btn btn-primary');

        parent::setupHtmlAttributes();
    }
}
