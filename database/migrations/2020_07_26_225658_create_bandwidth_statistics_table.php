<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandwidthStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bandwidth_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('email', 64);
            $table->date('month');
            $table->integer('usage', false, true);
            $table->integer('max_usage')->default(-1)->comment('当月最大用量，单位MB');
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
        Schema::dropIfExists('bandwidth_statistics');
    }
}
