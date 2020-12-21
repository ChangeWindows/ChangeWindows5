<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->integer('position');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('channel_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->references('id')->on('platforms');
            $table->foreignId('channel_id')->references('id')->on('channels');
            $table->string('name');
            $table->string('short_name');
            $table->integer('active')->default(1);
            $table->timestamps();
        });
            
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
        Schema::dropIfExists('channel_platforms');
        Schema::dropIfExists('channels');
    }
}
