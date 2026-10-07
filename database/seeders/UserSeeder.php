<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Administrator
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'admin@hebahweb.com',
            ],
            [
                'name' => 'Administrator',

                'username' => 'admin',

                'email' => 'admin@hebahweb.com',

                'phone' => null,

                'avatar' => null,

                'bio' => 'Website administrator.',

                'password' => bcrypt('password'),

                'role' => 'admin',

                'status' => 'active',

                'email_verified_at' => now(),

                'last_login_at' => null,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Demo User
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'user@hebahweb.com',
            ],
            [
                'name' => 'Demo User',

                'username' => 'user',

                'email' => 'user@hebahweb.com',

                'phone' => null,

                'avatar' => null,

                'bio' => 'Demo website user.',

                'password' => bcrypt('password'),

                'role' => 'user',

                'status' => 'active',

                'email_verified_at' => now(),

                'last_login_at' => null,
            ]
        );
    }
}
