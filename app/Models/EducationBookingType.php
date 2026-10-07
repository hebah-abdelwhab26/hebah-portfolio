<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationBookingType extends Model
{
    protected $table = 'education_booking_types';


    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | BASIC INFORMATION
        |--------------------------------------------------------------------------
        */

        'name',
        'slug',
        'description',
        'icon',


        /*
        |--------------------------------------------------------------------------
        | PRICE
        |--------------------------------------------------------------------------
        */

        'price',
        'currency',


        /*
        |--------------------------------------------------------------------------
        | SESSIONS
        |--------------------------------------------------------------------------
        */

        'total_sessions',
        'session_duration',


        /*
        |--------------------------------------------------------------------------
        | DISPLAY
        |--------------------------------------------------------------------------
        */

        'sort_order',
        'is_active',
    ];


    protected $casts = [

        'price' => 'decimal:2',

        'total_sessions' => 'integer',

        'session_duration' => 'integer',

        'sort_order' => 'integer',

        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | BOOKINGS
    |--------------------------------------------------------------------------
    */

    public function bookings(): HasMany
    {
        return $this->hasMany(
            EducationBooking::class,
            'education_booking_type_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->is_active === true;
    }


    public function isPackage(): bool
    {
        return (int) $this->total_sessions > 1;
    }


    public function isSingle(): bool
    {
        return (int) $this->total_sessions === 1;
    }


    public function getTypeLabelAttribute(): string
    {
        return $this->isPackage()
            ? 'باقة'
            : 'حصة واحدة';
    }
}
