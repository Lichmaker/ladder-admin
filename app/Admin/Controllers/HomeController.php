<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Admin\Repositories\AdminArticle;
use App\Components\BandwidthStatisticsSummaryHandler;
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
        $data = AdminArticle::getAnnouncementContent();
        $content->header('Ladder Admin')->description('欢迎使用 Ladder Admin 管理后台');

        $content->row(view('blank', compact('data')));

        $content->row('<HR>');

        $email = \Admin::user()->name;

        $clientAttributesModel = V2RayClientAttribute::where('email', '=', $email)->first();
        $vmess = empty($clientAttributesModel) ? '' : $clientAttributesModel->v2ray_vmess;
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

        return $content;
    }
}
