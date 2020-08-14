<?php

namespace App\Admin\Actions\Show;

use App\Admin\Repositories\V2RayClientAttribute;
use App\Components\BandwidthStatisticsHandler;
use App\Components\V2RayGRPC;
use chillerlan\QRCode\QRCode;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Show\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Grpc\RpcServer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TestAnything extends AbstractTool
{
    /**
     * @return string
     */
	protected $title = '测试按钮';

    protected $modalId = 'test-anything';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
    	// dump($this->getKey());
//
//        $a = new QRCode();
//        return $this->response()->html(view('blank', ['data' => "<img src='{$a->render('test')}'>"]));

        $byte = V2RayGRPC::getInstance()->getStatsByEmail('test-liuliang@wuguozhang.com')['stat']['value'];
        $stat = new BandwidthStatisticsHandler('test-liuliang@wuguozhang.com', $byte);
        $stat->stat();

        return $this->response()->html(view('blank', ['data' => $byte]));
    }

    /**
     * @return string|void
     */
    protected function href()
    {
        // return admin_url('auth/users');
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
