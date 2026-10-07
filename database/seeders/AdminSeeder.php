<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(

            [
                'email' => 'admin@hebahgift.com',
            ],

            [

                'name' => 'Hebah Abdelwahab',

                'username' => 'hebah',

                'phone' => null,

                'avatar' => null,

                'password' => Hash::make('Admin@123456'),

            ]

        );

        $admin->assignRole('Admin');
    }
}
