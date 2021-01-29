<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Ability;
use App\Model\HorizonAbility;

class HorizonCreateAbilitiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('description')->required();
            $table->timestamps();
        });

        $abilities = Ability::all();

        foreach ($abilities as $ability) {
            HorizonAbility::create([
                'name' => $ability->name,
                'description' => $ability->label
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_abilities');
    }
}
