<?php

namespace App\Admin\Actions;

use App\Components\V2RayServiceProvider;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateV2RayConfig extends Action
{
    /**
     * @return string
     */
    protected $title = '同步用户配置';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle()
    {
        try {
            V2RayServiceProvider::getInstance()->synchronizeConfig();
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
         return ['确认同步?', '确认后会把当前已有用户email的clients配置覆盖原有clients配置，并写入到数据库中'];
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
