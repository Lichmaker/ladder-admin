<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterV2rayClientActiveState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v2ray_client_attributes', function (Blueprint $table) {
            $table->string('active_state', 64)->default('activated')->comment('账号激活状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('v2ray_client_attributes', function (Blueprint $table) {
            $table->dropColumn('active_state');
        });
    }
}
