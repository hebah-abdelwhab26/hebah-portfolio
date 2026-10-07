<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            'dashboard.view',

            /*
            |--------------------------------------------------------------------------
            | Projects
            |--------------------------------------------------------------------------
            */

            'projects.view',
            'projects.create',
            'projects.edit',
            'projects.delete',
            'projects.publish',
            'projects.feature',

            /*
            |--------------------------------------------------------------------------
            | Project Categories
            |--------------------------------------------------------------------------
            */

            'project_categories.view',
            'project_categories.create',
            'project_categories.edit',
            'project_categories.delete',

            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            'technologies.view',
            'technologies.create',
            'technologies.edit',
            'technologies.delete',

            /*
            |--------------------------------------------------------------------------
            | Technology Categories
            |--------------------------------------------------------------------------
            */

            'technology_categories.view',
            'technology_categories.create',
            'technology_categories.edit',
            'technology_categories.delete',

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */

            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            /*
            |--------------------------------------------------------------------------
            | Permissions
            |--------------------------------------------------------------------------
            */

            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            'settings.view',
            'settings.edit',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([

                'name' => $permission,

                'guard_name' => 'web',

            ]);

        }
    }
}
