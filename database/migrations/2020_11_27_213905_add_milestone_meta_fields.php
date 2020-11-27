<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMilestoneMetaFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->integer('start_build')->unsigned()->nullable()->after('color');
            $table->integer('start_delta')->unsigned()->nullable()->after('color');
            $table->integer('end_build')->unsigned()->nullable()->after('color');
            $table->integer('end_delta')->unsigned()->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropColumn('start_build');
            $table->dropColumn('start_delta');
            $table->dropColumn('end_build');
            $table->dropColumn('end_delta');
        });
    }
}
