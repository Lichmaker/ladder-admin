<?php

namespace App\Admin\Actions;

use App\Components\V2RayServiceProvider;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RestartV2Ray extends Action
{
    /**
     * @return string
     */
	protected $title = '重启V2Ray';

    /**
     * Handle the action request.
     *
     *
     * @return Response
     */
    public function handle()
    {
        try {
            V2RayServiceProvider::getInstance()->restartApp();
        } catch (\Exception $exception) {
            return  $this->response()->error('处理失败，请检查日志获取信息。 msg : '.$exception->getMessage())->refresh();
        }
        return $this->response()->success('处理成功')->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
         return ['确认重启？', ''];
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
