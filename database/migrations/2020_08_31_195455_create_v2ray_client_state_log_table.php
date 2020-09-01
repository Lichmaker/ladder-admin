<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateV2rayClientStateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v2ray_client_state_log', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('memo')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v2ray_client_state_log');
    }
}
