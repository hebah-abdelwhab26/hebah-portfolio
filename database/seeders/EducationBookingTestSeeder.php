<?php

namespace Database\Seeders;

use App\Models\EducationBookingType;
use Illuminate\Database\Seeder;

class EducationBookingTestSeeder extends Seeder
{
    public function run(): void
    {
        EducationBookingType::updateOrCreate(
            ['slug' => 'single-lesson'],
            [
                'name' => 'حصة فردية',
                'description' => 'حجز حصة تعليمية واحدة.',
                'icon' => 'fa-solid fa-user',
                'price' => 60,
                'currency' => 'SAR',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        EducationBookingType::updateOrCreate(
            ['slug' => 'monthly-package'],
            [
                'name' => 'الباقة الشهرية',
                'description' => 'باقة شهرية تحتوي على 8 حصص تعليمية.',
                'icon' => 'fa-solid fa-calendar-days',
                'price' => 480,
                'currency' => 'SAR',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        EducationBookingType::updateOrCreate(
            ['slug' => 'custom-package'],
            [
                'name' => 'باقة مخصصة',
                'description' => 'باقة تعليمية مخصصة للطالب.',
                'icon' => 'fa-solid fa-layer-group',
                'price' => 0,
                'currency' => 'SAR',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );
    }
}
