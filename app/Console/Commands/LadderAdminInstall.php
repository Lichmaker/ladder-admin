<?php

namespace App\Console\Commands;

use App\Components\RemoteCommandHandler;
use App\Exceptions\RemoteCommandException;
use Illuminate\Console\Command;

class LadderAdminInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ladder-admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ladder-admin 安装';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 检测ssh配置是否正常
        $this->info('开始检测 ssh 配置是否正常');
        try {
            $this->info(RemoteCommandHandler::getInstance()->run('echo "connect success!"'));
        } catch (\Exception $exception) {
            $this->error("ssh 建立连接失败，请检查配置。 （{$exception->getMessage()}）");
            return 0;
        }

        $this->call('migrate');

        $userModel = config('admin.database.users_model');

        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => \LadderAdminSeeder::class]);
        }

        $this->info('恭喜您🎉！ 安装完成！ 初始账号： admin@ladder-admin.org ， 密码： admin');
        return 0;
    }
}
