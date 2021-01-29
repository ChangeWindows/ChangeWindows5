<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilitiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('ability_role', function (Blueprint $table) {
            $table->primary(['role_id', 'ability_id']);
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreignId('ability_id')->references('id')->on('abilities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ability_role');
        Schema::dropIfExists('abilities');
    }
}
