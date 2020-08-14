<?php

namespace App\Admin\Actions\Form;

use App\Components\V2RayServiceProvider;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Form;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EditV2RayConfig extends Action
{
    /**
     * @return string
     */
	protected $title = '手动编辑配置（DB）';

    /**
     * @var string
     */
    protected $modalId = 'edit-v2ray-config';

    /**
     * Handle the action request.a
     *
     * @return Response
     */
    public function handle()
    {
        try {
            $json = V2RayServiceProvider::getInstance()->getCurrentConfig(true, false);
        } catch (\Exception $exception) {
            return $this->response()->error($exception->getMessage());
        }


        $form = Form::make();
        $form->text('column')->readOnly()->default('v2ray_config_json');
        $form->textarea('value')->required()->default($json);
        $form->action('/v2ray/config/update');
        $form->title('编辑v2ray配置');
        $form->disableListButton();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
//        $form->disableAjaxSubmit(false);
//        $form->inDialog();

//        $form->ajaxResponse('success', );

        return $this->response()->html($form);
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
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
     * 处理响应的HTML字符串，附加到弹窗节点中
     *
     * @return string
     */
    protected function handleHtmlResponse()
    {
        return <<<'JS'
function m(target, html, data) {
    var $modal = $(target.data('target'));

    $modal.find('.modal-body').html(html)
    $modal.modal('show')
}
JS;
    }

    /**
     * 设置HTML标签的属性
     *
     * @return void
     */
    public function setupHtmlAttributes()
    {
        // 添加class
        $this->addHtmlClass('btn btn-primary btn-sm');

        // 保存弹窗的ID
        $this->setHtmlAttribute('data-target', '#'.$this->modalId);

        parent::setupHtmlAttributes();
    }

    /**
     * 设置按钮的HTML，这里我们需要附加上弹窗的HTML
     *
     * @return string|void
     */
    public function html()
    {
        // 按钮的html
        $html = parent::html();

        return <<<HTML
{$html}
<div class="modal fade" id="{$this->modalId}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{$this->title()}</h4>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
HTML;
    }
}
