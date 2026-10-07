<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationAdminNotification extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table =
        'education_admin_notifications';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'education_admin_id',

        'type',

        'title',

        'message',

        'icon',

        'color',

        'url',

        'read_at',

        'data',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'read_at' => 'datetime',

            'data' => 'array',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function admin(): BelongsTo
    {
        return $this->belongsTo(
            EducationAdmin::class,
            'education_admin_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UNREAD
    |--------------------------------------------------------------------------
    */

    public function scopeUnread($query)
    {
        return $query->whereNull(
            'read_at'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | READ
    |--------------------------------------------------------------------------
    */

    public function scopeRead($query)
    {
        return $query->whereNotNull(
            'read_at'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MARK AS READ
    |--------------------------------------------------------------------------
    */

    public function markAsRead(): void
    {
        if ($this->read_at === null) {

            $this->update([
                'read_at' => now(),
            ]);

        }
    }


    /*
    |--------------------------------------------------------------------------
    | MARK AS UNREAD
    |--------------------------------------------------------------------------
    */

    public function markAsUnread(): void
    {
        $this->update([
            'read_at' => null,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | IS READ
    |--------------------------------------------------------------------------
    */

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
}

