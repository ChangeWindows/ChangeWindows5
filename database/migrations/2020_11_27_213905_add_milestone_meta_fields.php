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
            $table->integer('start_build')->unsigned()->default(0)->after('color');
            
            $table->dropColumn('isLts');
            $table->dropColumn('pcSkip');
            $table->dropColumn('pcFast');
            $table->dropColumn('pcSlow');
            $table->dropColumn('pcReleasePreview');
            $table->dropColumn('pcTargeted');
            $table->dropColumn('pcBroad');
            $table->dropColumn('pcLTS');
            $table->dropColumn('xboxSkip');
            $table->dropColumn('xboxFast');
            $table->dropColumn('xboxSlow');
            $table->dropColumn('xboxPreview');
            $table->dropColumn('xboxReleasePreview');
            $table->dropColumn('xboxTargeted');
            $table->dropColumn('serverSlow');
            $table->dropColumn('serverTargeted');
            $table->dropColumn('serverLTS');
            $table->dropColumn('iotSlow');
            $table->dropColumn('iotTargeted');
            $table->dropColumn('iotBroad');
            $table->dropColumn('teamFast');
            $table->dropColumn('teamSlow');
            $table->dropColumn('teamTargeted');
            $table->dropColumn('teamBroad');
            $table->dropColumn('holographicFast');
            $table->dropColumn('holographicSlow');
            $table->dropColumn('holographicTargeted');
            $table->dropColumn('holographicBroad');
            $table->dropColumn('holographicLTS');
            $table->dropColumn('tenXSlow');
            $table->dropColumn('sdk');
            $table->dropColumn('iso');
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
            
            $table->integer('isLts')->unsigned();
            $table->integer('pcSkip')->unsigned();
            $table->integer('pcFast')->unsigned();
            $table->integer('pcSlow')->unsigned();
            $table->integer('pcReleasePreview')->unsigned();
            $table->integer('pcTargeted')->unsigned();
            $table->integer('pcBroad')->unsigned();
            $table->integer('pcLTS')->unsigned();
            $table->integer('mobileFast')->unsigned();
            $table->integer('mobileSlow')->unsigned();
            $table->integer('mobileReleasePreview')->unsigned();
            $table->integer('mobileTargeted')->unsigned();
            $table->integer('mobileBroad')->unsigned();
            $table->integer('xboxSkip')->unsigned();
            $table->integer('xboxFast')->unsigned();
            $table->integer('xboxSlow')->unsigned();
            $table->integer('xboxPreview')->unsigned();
            $table->integer('xboxReleasePreview')->unsigned();
            $table->integer('xboxTargeted')->unsigned();
            $table->integer('serverSlow')->unsigned();
            $table->integer('serverTargeted')->unsigned();
            $table->integer('serverLTS')->unsigned();
            $table->integer('iotSlow')->unsigned();
            $table->integer('iotTargeted')->unsigned();
            $table->integer('iotBroad')->unsigned();
            $table->integer('teamTargeted')->unsigned();
            $table->integer('teamBroad')->unsigned();
            $table->integer('holographicFast')->unsigned();
            $table->integer('holographicSlow')->unsigned();
            $table->integer('holographicTargeted')->unsigned();
            $table->integer('holographicBroad')->unsigned();
            $table->integer('holographicLTS')->unsigned();
            $table->integer('sdk')->unsigned();
            $table->integer('iso')->unsigned();
        });
    }
}
