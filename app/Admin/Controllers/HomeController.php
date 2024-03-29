<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Admin\Repositories\AdminArticle;
use App\Components\BandwidthStatisticsSummaryHandler;
use App\Components\V2RayServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\V2RayClientAttribute;
use chillerlan\QRCode\QRCode;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Markdown;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $content->header('Ladder Admin')->description('欢迎使用 Ladder Admin 管理后台');
        $content->row('<HR>');

        $email = \Admin::user()->username;

        $clientAttributesModel = V2RayClientAttribute::where('email', '=', $email)->first();
//        $vmess = empty($clientAttributesModel) ? '' : $clientAttributesModel->v2ray_vmess;

        $v2rayConfig = V2RayServiceProvider::getInstance()->generateVmessConfig($clientAttributesModel->uuid, $email);
        $vmess = $v2rayConfig['vmessURL'];

        $statModel = BandwidthStatisticsSummaryHandler::getInstance()->getModel($email);
        if (empty($statModel)) {
            $max = empty($clientAttributesModel) ? '' : $clientAttributesModel->bandwidth_usage_max.'MB';
            $usage = 0;
        } else {
            $max = $statModel->max_usage.'MB';
            $usage = convertToReadableSize($statModel->usage);
        }
        $qrCode = new QRCode();
        $imgSrc = empty($vmess) ? '' : $qrCode->render($vmess);
        $content->row(view('user-home', compact('email', 'vmess', 'max', 'usage', 'imgSrc')));

        $data = AdminArticle::getAnnouncementContent();
        $content->row(view('blank', compact('data')));

        return $content;
    }
}
