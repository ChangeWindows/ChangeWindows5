<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->description = 'Administrates ChangeWindows';
        $admin->save();
    
        $insider = new Role();
        $insider->name = 'Insider';
        $insider->description = 'Those who test ChangeWindows';
        $insider->save();
    
        $user = new Role();
        $user->name = 'User';
        $user->description = 'User with a user account';
        $user->save();
    }
}
