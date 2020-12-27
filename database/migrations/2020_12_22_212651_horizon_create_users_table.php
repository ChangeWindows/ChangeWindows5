<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Model\HorizonRole;
use App\Model\HorizonUser;

class HorizonCreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar_path')->nullable();
            $table->integer('theme')->default('0');
            $table->string('onboarding')->nullable();
            $table->foreignId('role_id')->constrained('h_roles')->default(4);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $users = User::all();

        foreach ($users as $user) {
            $h_role = HorizonRole::where('name', '=', $user->role->name)->first();

            HorizonUser::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar_path' => $user->avatar_path,
                'theme' => $user->theme > 0 ? 1 : 0,
                'onboarding' => $user->onboarding,
                'email_verified_at' => $user->email_verified_at,
                'role_id' => $h_role->id,
                'password' => $user->password,
                'remember_token' => $user->remember_token
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('h_users');
    }
}
