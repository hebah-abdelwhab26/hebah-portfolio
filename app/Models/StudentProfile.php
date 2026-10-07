<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [

        'user_id',

        'phone',

        'whatsapp_number',

        'whatsapp_reminders_enabled',

        'education_level',

        'learning_goal',

        'is_active',

    ];


    protected $casts = [

        'whatsapp_reminders_enabled' => 'boolean',

        'is_active' => 'boolean',

    ];


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
