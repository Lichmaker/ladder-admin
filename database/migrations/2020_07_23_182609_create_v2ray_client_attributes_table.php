<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateV2RayClientAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v2ray_client_attributes', function (Blueprint $table) {
            $table->integer('admin_user_id')->primary()->comment('admin_users表的id');
            $table->string('email', 64)->unique();
            $table->integer('bandwidth_usage_max')->default(0)->comment('每月最大的流量使用，单位MB');
//            $table->string('v2ray_qrcode', '1000')->default('#')->comment('使用vemss url生成的二维码');
            $table->text('v2ray_vmess')->comment('vemss url');
            $table->string('uuid', '255');
            $table->timestamp('expire_at')->comment('账户过期时间');
            $table->timestamp('stat_updated_at')->nullable()->useCurrent()->comment('上一次统计时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v2ray_client_attributes');
    }
}
