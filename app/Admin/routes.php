<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/help/home', 'HelpController@home');

    // v2ray 管理
    $router->get('/v2ray/dashboard', 'V2RayController@dashboard');
    $router->get('/v2ray/config/show', 'V2RayController@showConfig');
    $router->post('/v2ray/config/update', 'V2RayController@updateConfiguration');

    // 统计相关
    $router->get('statistics/my', 'StatisticsController@my');

    $router->resource('admin-articles', 'AdminArticleController');
    $router->resource('v2ray-client-attributes', 'V2RayClientAttributeController');
    $router->resource('bandwidth-statistics', 'BandwidthStatisticController');
    $router->resource('data-summary', 'DataSummaryController');

    $router->post('auth/users', 'UserController@store');
});
