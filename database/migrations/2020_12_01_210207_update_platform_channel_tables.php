<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePlatformChannelTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channel_platforms', function (Blueprint $table) {
            $table->string('short_name')->after('channel_id');
            $table->string('name')->after('channel_id');
        });
        
        Schema::table('platforms', function (Blueprint $table) {
            $table->integer('position')->after('icon')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channel_platforms', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('short_name');
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}
