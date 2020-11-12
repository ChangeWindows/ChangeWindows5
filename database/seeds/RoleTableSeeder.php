<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role;
use App\Ability;

class RoleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin = Role::create([
            'name' => 'Admin',
            'description' => 'Has all rights.',
            'is_default' => 0
        ]);

        $editor = Role::create([
            'name' => 'Editor',
            'description' => 'Can manage most content.',
            'is_default' => 0
        ]);

        Role::create([
            'name' => 'Insider',
            'description' => 'Have access to some limited features.',
            'is_default' => 0
        ]);

        Role::create([
            'name' => 'User',
            'description' => 'Has no access to the Backstage.',
            'is_default' => 1
        ]);

        $view_backstage = Ability::create([
            'name' => 'view_backstage',
            'label' => 'Can view the Backstage.'
        ]);

        $create_flight = Ability::create([
            'name' => 'create_flight',
            'label' => 'Can create flights.'
        ]);

        $show_users = Ability::create([
            'name' => 'show_users',
            'label' => 'Can view users.'
        ]);

        $edit_user = Ability::create([
            'name' => 'edit_user',
            'label' => 'Can edit user.'
        ]);

        $delete_user = Ability::create([
            'name' => 'delete_user',
            'label' => 'Can remoe user.'
        ]);

        $show_abilities = Ability::create([
            'name' => 'show_abilities',
            'label' => 'Can view permissions.'
        ]);

        $create_ability = Ability::create([
            'name' => 'create_ability',
            'label' => 'Can create permission.'
        ]);

        $edit_ability = Ability::create([
            'name' => 'edit_ability',
            'label' => 'Can edit permission.'
        ]);

        $assign_ability = Ability::create([
            'name' => 'assign_ability',
            'label' => 'Can assign permission to role.'
        ]);

        $show_roles = Ability::create([
            'name' => 'show_roles',
            'label' => 'Can view roles.'
        ]);

        $create_role = Ability::create([
            'name' => 'create_role',
            'label' => 'Can create role.'
        ]);

        $edit_role = Ability::create([
            'name' => 'edit_role',
            'label' => 'Can edit role.'
        ]);

        $delete_role = Ability::create([
            'name' => 'delete_role',
            'label' => 'Can remoe role.'
        ]);

        $edit_settings = Ability::create([
            'name' => 'edit_settings',
            'label' => 'Can edit settings.'
        ]);

        $view_settings = Ability::create([
            'name' => 'view_settings',
            'label' => 'Can edit settings.'
        ]);

        $admin->abilities()->attach($view_backstage->id);
        $editor->abilities()->attach($view_backstage->id);
        $admin->abilities()->attach($create_flight->id);
        $editor->abilities()->attach($create_flight->id);

        $admin->abilities()->attach($show_users->id);
        $admin->abilities()->attach($edit_user->id);
        $admin->abilities()->attach($delete_user->id);
        $admin->abilities()->attach($show_abilities->id);
        $admin->abilities()->attach($create_ability->id);
        $admin->abilities()->attach($edit_ability->id);
        $admin->abilities()->attach($assign_ability->id);
        $admin->abilities()->attach($show_roles->id);
        $admin->abilities()->attach($create_role->id);
        $admin->abilities()->attach($edit_role->id);
        $admin->abilities()->attach($delete_role->id);
        $admin->abilities()->attach($edit_settings->id);
        $admin->abilities()->attach($view_settings->id);

        $editor->abilities()->attach($show_users->id);
        $editor->abilities()->attach($edit_user->id);
        $editor->abilities()->attach($show_abilities->id);
        $editor->abilities()->attach($show_roles->id);
        $editor->abilities()->attach($view_settings->id);
    }
}
