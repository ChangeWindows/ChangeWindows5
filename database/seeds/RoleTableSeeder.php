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
            'id' => 1,
            'name' => 'Admin',
            'description' => 'Has all rights.',
            'is_default' => 0
        ]);

        $editor = Role::create([
            'id' => 2,
            'name' => 'Editor',
            'description' => 'Can manage most content.',
            'is_default' => 0
        ]);

        Role::create([
            'id' => 3,
            'name' => 'Insider',
            'description' => 'Have access to some limited features.',
            'is_default' => 0
        ]);

        Role::create([
            'id' => 4,
            'name' => 'User',
            'description' => 'Has no access to the Backstage.',
            'is_default' => 1
        ]);

        $view_backstage = Ability::create([
            'name' => 'view_backstage',
            'label' => 'Can view the Backstage.'
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
            'label' => 'Can remove user.'
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
            'label' => 'Can remove role.'
        ]);

        $show_flights = Ability::create([
            'name' => 'show_flights',
            'label' => 'Can view flights.'
        ]);

        $create_flight = Ability::create([
            'name' => 'create_flight',
            'label' => 'Can create flight.'
        ]);

        $edit_flight = Ability::create([
            'name' => 'edit_flight',
            'label' => 'Can edit flight.'
        ]);

        $delete_flight = Ability::create([
            'name' => 'delete_flight',
            'label' => 'Can remove flight.'
        ]);

        $show_milestones = Ability::create([
            'name' => 'show_milestones',
            'label' => 'Can view milestones.'
        ]);

        $create_milestone = Ability::create([
            'name' => 'create_milestone',
            'label' => 'Can create milestone.'
        ]);

        $edit_milestone = Ability::create([
            'name' => 'edit_milestone',
            'label' => 'Can edit milestone.'
        ]);

        $delete_milestone = Ability::create([
            'name' => 'delete_milestone',
            'label' => 'Can remove milestone.'
        ]);

        $show_logs = Ability::create([
            'name' => 'show_logs',
            'label' => 'Can view logs.'
        ]);

        $create_log = Ability::create([
            'name' => 'create_log',
            'label' => 'Can create log.'
        ]);

        $edit_log = Ability::create([
            'name' => 'edit_log',
            'label' => 'Can edit log.'
        ]);

        $delete_log = Ability::create([
            'name' => 'delete_log',
            'label' => 'Can remove log.'
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
        $admin->abilities()->attach($show_flights);
        $admin->abilities()->attach($create_flight);
        $admin->abilities()->attach($edit_flight);
        $admin->abilities()->attach($delete_flight);
        $admin->abilities()->attach($show_milestones);
        $admin->abilities()->attach($create_milestone);
        $admin->abilities()->attach($edit_milestone);
        $admin->abilities()->attach($delete_milestone);
        $admin->abilities()->attach($show_logs);
        $admin->abilities()->attach($create_log);
        $admin->abilities()->attach($edit_log);
        $admin->abilities()->attach($delete_log);

        $editor->abilities()->attach($view_backstage->id);
        $editor->abilities()->attach($show_users->id);
        $editor->abilities()->attach($edit_user->id);
        $editor->abilities()->attach($show_abilities->id);
        $editor->abilities()->attach($show_roles->id);
        $editor->abilities()->attach($view_settings->id);
        $editor->abilities()->attach($show_flights);
        $editor->abilities()->attach($create_flight);
        $editor->abilities()->attach($edit_flight);
        $editor->abilities()->attach($show_milestones);
        $editor->abilities()->attach($create_milestone);
        $editor->abilities()->attach($edit_milestone);
        $editor->abilities()->attach($show_logs);
        $editor->abilities()->attach($create_log);
        $editor->abilities()->attach($edit_log);
    }
}
