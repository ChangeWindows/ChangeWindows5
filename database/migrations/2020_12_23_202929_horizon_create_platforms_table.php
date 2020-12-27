<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Platform;
use App\Model\HorizonPlatform;

class HorizonCreatePlatformsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->string('icon');
            $table->integer('position')->default(1);
            $table->integer('active')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $platforms = Platform::all();

        foreach ($platforms as $platform) {
            HorizonPlatform::create([
                'name' => $platform->name,
                'color' => $platform->color,
                'icon' => $platform->icon,
                'position' => $platform->position,
                'active' => $platform->active
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_platforms');
    }
}
