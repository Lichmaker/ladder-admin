<?php

use App\Models\AdminArticle;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Permission;
use Dcat\Admin\Models\Role;
use Illuminate\Database\Seeder;

class LadderAdminSeeder extends Seeder
{
    /**
     * Run the ladder-admin database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = date('Y-m-d H:i:s');

        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username'   => 'admin@ladder-admin.org',
            'password'   => bcrypt('admin'),
            'name'       => 'admin@ladder-admin.org',
            'created_at' => $createdAt,
        ]);

        // create a role.
        Role::truncate();
        Role::insert([
            [
                'name'       => 'Administrator',
                'slug'       => Role::ADMINISTRATOR,
                'created_at' => $createdAt,
            ],
            [
                'name'       => '普通用户',
                'slug'       => 'normal',
                'created_at' => $createdAt,
            ]
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'id'          => 1,
                'name'        => 'Auth management',
                'slug'        => 'auth-management',
                'http_method' => '',
                'http_path'   => '',
                'parent_id'   => 0,
                'order'       => 1,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 2,
                'name'        => 'Users',
                'slug'        => 'users',
                'http_method' => '',
                'http_path'   => '/auth/users*',
                'parent_id'   => 1,
                'order'       => 2,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 3,
                'name'        => 'Roles',
                'slug'        => 'roles',
                'http_method' => '',
                'http_path'   => '/auth/roles*',
                'parent_id'   => 1,
                'order'       => 3,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 4,
                'name'        => 'Permissions',
                'slug'        => 'permissions',
                'http_method' => '',
                'http_path'   => '/auth/permissions*',
                'parent_id'   => 1,
                'order'       => 4,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 5,
                'name'        => 'Menu',
                'slug'        => 'menu',
                'http_method' => '',
                'http_path'   => '/auth/menu*',
                'parent_id'   => 1,
                'order'       => 5,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 6,
                'name'        => 'Operation log',
                'slug'        => 'operation-log',
                'http_method' => '',
                'http_path'   => '/auth/logs*',
                'parent_id'   => 1,
                'order'       => 6,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 7,
                'name'        => '文章管理',
                'slug'        => 'admin-articles',
                'http_method' => '',
                'http_path'   => '/admin-articles*',
                'parent_id'   => 0,
                'order'       => 7,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 8,
                'name'        => '帮助中心',
                'slug'        => 'help',
                'http_method' => '',
                'http_path'   => '/help/home',
                'parent_id'   => 0,
                'order'       => 8,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 9,
                'name'        => '统计相关',
                'slug'        => 'bandwidth-statistics',
                'http_method' => '',
                'http_path'   => '/auth/logs*',
                'parent_id'   => 0,
                'order'       => 9,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 10,
                'name'        => '全部流量统计',
                'slug'        => 'bandwidth-statistics-all',
                'http_method' => '',
                'http_path'   => '/bandwidth-statistics*',
                'parent_id'   => 9,
                'order'       => 10,
                'created_at'  => $createdAt,
            ],
            [
                'id'          => 11,
                'name'        => '我的流量统计',
                'slug'        => 'bandwidth-statistics-my',
                'http_method' => '',
                'http_path'   => '/statistics/my',
                'parent_id'   => 9,
                'order'       => 11,
                'created_at'  => $createdAt,
            ],
        ]);

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id'     => 0,
                'order'         => 1,
                'title'         => 'Index',
                'icon'          => 'feather icon-bar-chart-2',
                'uri'           => '/',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 2,
                'title'         => 'v2ray管理',
                'icon'          => 'feather icon-settings',
                'uri'           => '/v2ray',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 2,
                'order'         => 3,
                'title'         => 'v2ray用户管理',
                'icon'          => 'feather icon-settings',
                'uri'           => '/v2ray-client-attributes',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 2,
                'order'         => 4,
                'title'         => '系统操作',
                'icon'          => 'feather icon-settings',
                'uri'           => '/v2ray/dashboard',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 5,
                'title'         => '统计相关',
                'icon'          => 'fa-bar-chart',
                'uri'           => NULL,
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 5,
                'order'         => 6,
                'title'         => '我的流量数据',
                'icon'          => 'feather icon-settings',
                'uri'           => '/statistics/my',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 5,
                'order'         => 7,
                'title'         => '所有流量数据',
                'icon'          => 'feather icon-settings',
                'uri'           => '/bandwidth-statistics',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 8,
                'title'         => 'Admin',
                'icon'          => 'feather icon-settings',
                'uri'           => '',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 8,
                'order'         => 9,
                'title'         => 'Users',
                'icon'          => '',
                'uri'           => 'auth/users',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 8,
                'order'         => 10,
                'title'         => 'Roles',
                'icon'          => '',
                'uri'           => 'auth/roles',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 8,
                'order'         => 11,
                'title'         => 'Permission',
                'icon'          => '',
                'uri'           => 'auth/permissions',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 8,
                'order'         => 12,
                'title'         => 'Menu',
                'icon'          => '',
                'uri'           => 'auth/menu',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 8,
                'order'         => 13,
                'title'         => 'Operation log',
                'icon'          => '',
                'uri'           => 'auth/logs',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 14,
                'title'         => '系统文章',
                'icon'          => 'fa-align-justify',
                'uri'           => '/admin-articles',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 15,
                'title'         => '帮助中心',
                'icon'          => 'fa-question-circle',
                'uri'           => '/help/home',
                'created_at'    => $createdAt,
            ],
        ]);

        // add menu permission
        Menu::where('id', '=', 14)->first()->permissions()->save(Permission::where('id', '=', 7)->first());
        Menu::where('id', '=', 7)->first()->permissions()->save(Permission::where('id', '=', 10)->first());
        Menu::where('id', '=', 6)->first()->permissions()->save(Permission::where('id', '=', 11)->first());

        // add role admin
        $admin = Role::where('id', '=', 1)->first();
        $normal = Role::where('id', '=', 2)->first();
        Menu::where('id', '=', 8)->first()->roles()->save($admin);
        Menu::where('id', '=', 14)->first()->roles()->save($admin);
        Menu::where('id', '=', 2)->first()->roles()->save($admin);
        Menu::where('id', '=', 3)->first()->roles()->save($admin);
        Menu::where('id', '=', 4)->first()->roles()->save($admin);
        Menu::where('id', '=', 7)->first()->roles()->save($admin);
        Menu::where('id', '=', 6)->first()->roles()->save($normal);
        Menu::where('id', '=', 15)->first()->roles()->save($normal);

        // add role permission
        $normal->permissions()->save(Permission::where('id', '=', 8)->first());
        $normal->permissions()->save(Permission::where('id', '=', 11)->first());

        // add default article
        AdminArticle::create([
            'created_at' => $createdAt,
            'tag' => 'announcement',
            'content' => <<<CONTENT
> i'm announcement content
CONTENT
        ]);
        AdminArticle::create([
            'created_at' => $createdAt,
            'tag' => 'helperHomepage',
            'content' => <<<CONTENT
> i'm helperHomepage content
CONTENT
        ]);



        (new Menu())->flushCache();
    }
}
