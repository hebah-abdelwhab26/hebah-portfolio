<?php

namespace Database\Seeders;

use App\Models\EducationAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EducationAdminSeeder extends Seeder
{
    /**
     * Seed the education admin account.
     */
    public function run(): void
    {
        EducationAdmin::updateOrCreate(
            [
                'email' => 'education@hebahgift.com',
            ],
            [
                'name' => 'Hebah Education Admin',
                'password' => Hash::make('Education@12345'),
                'is_active' => true,
                'avatar' => null,
            ]
        );
    }
}
