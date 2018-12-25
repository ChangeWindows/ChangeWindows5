<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('osname');
            $table->string('name');
            $table->string('codename');
            $table->integer('version')->unsigned();
            $table->string('color');
            $table->text('description');
            $table->date('preview');
            $table->date('public');
            $table->date('mainEol');
            $table->date('mainXol');
            $table->date('ltsEol');
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
        Schema::dropIfExists('milestones');
    }
}
