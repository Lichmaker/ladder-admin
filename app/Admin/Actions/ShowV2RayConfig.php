<?php

namespace App\Admin\Actions;

use App\Components\V2RayServiceProvider;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShowV2RayConfig extends Action
{
    /**
     * @return string
     */
	protected $title = 'v2ray配置预览';

	private $parametersStash = [];

    /**
     * @var string
     */
    protected $modalId = 'show-v2ray-config';

    public function __construct($title = NULL, $requestParams = [])
    {
        $this->parametersStash = $requestParams;
        // 因为这个 Action 的 selector 是根据 className 做处理。如果同一个页面使用多次就会导致某些奇怪的错误。所以这里实例化的时候自己新生成一个 selector 做区分
        $this->selector = $this->makeSelector($this->selectorPrefix, uniqid());
        parent::__construct($title);
    }

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
            $fromDb = boolval($request->get('fromDb'));
//            return $this->response()->success(intval($fromDb));
            $json = V2RayServiceProvider::getInstance()->getCurrentConfig($fromDb, false);
        } catch (\Exception $exception) {
            return  $this->response()->error($exception->getMessage());
        }

        $html = \Parsedown::instance()->text(<<<EOL
```JSON
$json
```
EOL
        );
        return $this->response()->html($html);
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
        return $this->parametersStash;
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
    protected function setupHtmlAttributes()
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
