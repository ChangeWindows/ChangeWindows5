<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $role_user  = Role::where('name', 'User')->first();
    
        $admin = new User();
        $admin->name = 'Yannick';
        $admin->email = 'yannick@changewindows.org';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);
    
        $user = new User();
        $user->name = 'Tom';
        $user->email = 'tom@changewindows.org';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
