<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Admin\Repositories\AdminArticle;
use App\Http\Controllers\Controller;
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

        $content->row(view('blank', ['data' => \Parsedown::instance()->text(<<<EOL
# {$email}，欢迎您使用本系统

EOL
)]));

        return $content;
    }
}
