<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    /**
     * ==========================================
     * Mass Assignable
     * ==========================================
     */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */

        'name',
        'username',
        'email',
        'phone',
        'avatar',
        'bio',

        /*
        |--------------------------------------------------------------------------
        | Account
        |--------------------------------------------------------------------------
        */

        'role',
        'status',

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        'google_id',
        'password',
        'last_login_at',

    ];


    /**
     * ==========================================
     * Hidden Attributes
     * ==========================================
     */

    protected $hidden = [

        'password',
        'remember_token',

    ];


    /**
     * ==========================================
     * Attribute Casting
     * ==========================================
     */

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'last_login_at' => 'datetime',

            'password' => 'hashed',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {

            return asset(
                'images/users/' . $this->avatar
            );
        }

        return asset(
            'images/default-avatar.png'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }


    public function isAdmin(): bool
    {
        return in_array(
            $this->role,
            [
                'super_admin',
                'admin',
            ]
        );
    }


    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }


    public function isUser(): bool
    {
        return $this->role === 'user';
    }


    public function isActive(): bool
    {
        return $this->status === 'active';
    }


    /*
    |--------------------------------------------------------------------------
    | Conversations
    |--------------------------------------------------------------------------
    */

    public function conversations(): HasMany
    {
        return $this->hasMany(
            Conversation::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Conversation Messages
    |--------------------------------------------------------------------------
    */

    public function conversationMessages(): HasMany
    {
        return $this->hasMany(
            ConversationMessage::class
        );
    }
}
