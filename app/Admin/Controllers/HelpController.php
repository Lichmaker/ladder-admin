<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AdminArticle;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;

class HelpController extends AdminController
{
    public function home(Content $content)
    {
        $content->header('帮助中心')->description('欢迎来到帮助中心');

        $data = AdminArticle::getHelperHomepageContent();
        $content->row(view('blank', compact('data')));

        return $content;
    }
}
