<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMilestonesFieldsLegacyRings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function (Blueprint $table) {
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
        //
    }
}
