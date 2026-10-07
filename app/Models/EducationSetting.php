<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationSetting extends Model
{
    protected $table = 'education_settings';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Bank
        'bank_name',
        'account_name',
        'account_number',
        'iban',

        // Payment
        'payment_enabled',
        'payment_instructions',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'payment_enabled' => 'boolean',

    ];
}
