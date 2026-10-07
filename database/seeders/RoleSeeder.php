<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Create Roles
        |--------------------------------------------------------------------------
        */

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);

        $editor = Role::firstOrCreate([
            'name' => 'Editor',
            'guard_name' => 'web',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Admin Permissions
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions(Permission::all());

        /*
        |--------------------------------------------------------------------------
        | Manager Permissions
        |--------------------------------------------------------------------------
        */

        $manager->syncPermissions([

            'dashboard.view',

            'projects.view',
            'projects.create',
            'projects.edit',
            'projects.delete',
            'projects.publish',
            'projects.feature',

            'project_categories.view',
            'project_categories.create',
            'project_categories.edit',
            'project_categories.delete',

            'technologies.view',
            'technologies.create',
            'technologies.edit',
            'technologies.delete',

            'technology_categories.view',
            'technology_categories.create',
            'technology_categories.edit',
            'technology_categories.delete',

            'settings.view',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Editor Permissions
        |--------------------------------------------------------------------------
        */

        $editor->syncPermissions([

            'dashboard.view',

            'projects.view',
            'projects.create',
            'projects.edit',

            'project_categories.view',

            'technologies.view',

        ]);

    }
}
