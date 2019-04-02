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
        $admin = new User();
        $admin->name = 'Yannick';
        $admin->email = 'yannick@changewindows.org';
        $admin->password = bcrypt('secret');
        $admin->role_id = 1;
        $admin->save();
    
        $insider = new User();
        $insider->name = 'Viv';
        $insider->email = 'viv@changewindows.org';
        $insider->password = bcrypt('secret');
        $admin->role_id = 10;
        $insider->save();
    
        $user = new User();
        $user->name = 'Tom';
        $user->email = 'tom@changewindows.org';
        $user->password = bcrypt('secret');
        $admin->role_id = 20;
        $user->save();
    }
}
