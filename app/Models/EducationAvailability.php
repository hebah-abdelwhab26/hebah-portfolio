<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationAvailability extends Model
{
    protected $table = 'education_availabilities';


    protected $fillable = [

        'day_of_week',

        'start_time',
        'end_time',

        'is_active',

        'label',

        'sort_order',

    ];


    protected function casts(): array
    {
        return [

            'day_of_week' => 'integer',

            'is_active' => 'boolean',

            'sort_order' => 'integer',

        ];
    }


    /**
     * Arabic day name.
     */
    public function getDayNameAttribute(): string
    {
        return match ($this->day_of_week) {

            0 => 'الأحد',

            1 => 'الاثنين',

            2 => 'الثلاثاء',

            3 => 'الأربعاء',

            4 => 'الخميس',

            5 => 'الجمعة',

            6 => 'السبت',

            default => '',

        };
    }
}
