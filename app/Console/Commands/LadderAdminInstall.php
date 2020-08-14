<?php

namespace App\Console\Commands;

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
        $this->call('migrate');

        $userModel = config('admin.database.users_model');

        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => \LadderAdminSeeder::class]);
        }

        return 0;
    }
}
