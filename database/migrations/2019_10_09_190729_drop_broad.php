<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Release;

class DropBroad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Release::where('ring', '=', '7')->delete();
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropColumn('pcBroad');
            $table->dropColumn('mobileBroad');
            $table->dropColumn('iotBroad');
            $table->dropColumn('teamBroad');
            $table->dropColumn('holographicBroad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // If we want to reverse this one... well... to bad...
    }
}
