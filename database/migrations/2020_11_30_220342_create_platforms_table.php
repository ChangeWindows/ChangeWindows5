<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->string('icon');
            $table->integer('active')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('milestone_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->references('id')->on('platforms');
            $table->foreignId('milestone_id')->references('id')->on('milestones');
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
        Schema::dropIfExists('milestone_platforms');
        Schema::dropIfExists('platforms');
    }
}
