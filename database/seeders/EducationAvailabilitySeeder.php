<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationAvailability;

class EducationAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EducationAvailability::create([
            'day_of_week' => 0,
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
            'is_active' => true,
            'label' => 'الحصة الصباحية',
            'sort_order' => 1,
        ]);

        EducationAvailability::create([
            'day_of_week' => 0,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'is_active' => true,
            'label' => 'الحصة الصباحية المتأخرة',
            'sort_order' => 2,
        ]);

        EducationAvailability::create([
            'day_of_week' => 1,
            'start_time' => '16:00:00',
            'end_time' => '17:00:00',
            'is_active' => true,
            'label' => 'الحصة المسائية',
            'sort_order' => 1,
        ]);

        EducationAvailability::create([
            'day_of_week' => 1,
            'start_time' => '18:00:00',
            'end_time' => '19:00:00',
            'is_active' => true,
            'label' => 'الحصة المسائية',
            'sort_order' => 2,
        ]);

        EducationAvailability::create([
            'day_of_week' => 2,
            'start_time' => '17:00:00',
            'end_time' => '18:00:00',
            'is_active' => true,
            'label' => 'حصة القرآن',
            'sort_order' => 1,
        ]);

        EducationAvailability::create([
            'day_of_week' => 3,
            'start_time' => '19:00:00',
            'end_time' => '20:00:00',
            'is_active' => true,
            'label' => 'حصة التجويد',
            'sort_order' => 1,
        ]);

        EducationAvailability::create([
            'day_of_week' => 4,
            'start_time' => '16:00:00',
            'end_time' => '17:00:00',
            'is_active' => true,
            'label' => 'الحصة المسائية',
            'sort_order' => 1,
        ]);

        EducationAvailability::create([
            'day_of_week' => 6,
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'is_active' => true,
            'label' => 'الحصة الصباحية',
            'sort_order' => 1,
        ]);

        /*
        |--------------------------------------------------------------------------
        | INACTIVE SLOT
        |--------------------------------------------------------------------------
        |
        | للتأكد من أن النظام يميز بين الوقت المتاح وغير المتاح.
        |
        */

        EducationAvailability::create([
            'day_of_week' => 6,
            'start_time' => '14:00:00',
            'end_time' => '15:00:00',
            'is_active' => false,
            'label' => 'موعد متوقف مؤقتًا',
            'sort_order' => 2,
        ]);
    }
}
