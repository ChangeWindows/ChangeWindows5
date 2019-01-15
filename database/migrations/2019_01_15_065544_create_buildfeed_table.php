<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildfeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildfeed', function (Blueprint $table) {
            $table->integer('major');
            $table->integer('minor');
            $table->integer('build');
            $table->integer('revision');
            $table->string('lab');
            $table->string('buildtime');
            $table->integer('family');
            $table->integer('sourcetype');
            $table->text('sourcedetails')->nullable();
            $table->text('leakdate')->nullable();
            $table->string('buildstring')->unique();
            $table->string('alternatebuildstring');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildfeed');
    }
}