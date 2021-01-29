<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Role;
use App\Model\HorizonRole;
use App\Model\HorizonAbility;

class HorizonCreateRoleAbilitiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('h_role_abilities', function (Blueprint $table) {
            $table->primary(['role_id', 'ability_id']);
            $table->foreignId('role_id')->constrained('h_roles')->onDelete('cascade');
            $table->foreignId('ability_id')->constrained('h_abilities')->onDelete('cascade');
            $table->timestamps();
        });

        $roles = Role::all();

        foreach ($roles as $role) {
            $h_role = HorizonRole::create([
                'name' => $role->name,
                'description' => $role->description,
                'is_default' => $role->is_default
            ]);

            foreach ($role->abilities as $ability) {
                $h_ability = HorizonAbility::where('name', '=', $ability->name)->first();

                $h_role->abilities()->attach($h_ability);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_role_abilities');
    }
}
