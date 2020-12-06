<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelMilestonePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_milestone_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_platform_id')->references('id')->on('channel_platforms');
            $table->foreignId('milestone_platform_id')->references('id')->on('milestone_platforms');
            $table->integer('active')->required()->default(1);
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
        Schema::dropIfExists('channel_milestone_platforms');
    }
}
