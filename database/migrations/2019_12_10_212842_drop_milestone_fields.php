<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMilestoneFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('mobileFast');
            $table->dropColumn('mobileSlow');
            $table->dropColumn('mobileReleasePreview');
            $table->dropColumn('mobileTargeted');
            $table->dropColumn('mobileBroad');
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
            $table->text('description')->nullable();
            $table->integer('mobileFast')->unsigned();
            $table->integer('mobileSlow')->unsigned();
            $table->integer('mobileReleasePreview')->unsigned();
            $table->integer('mobileTargeted')->unsigned();
            $table->integer('mobileBroad')->unsigned();
        });
    }
}
