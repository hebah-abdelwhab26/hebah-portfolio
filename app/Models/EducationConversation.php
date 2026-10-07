<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationConversation extends Model
{
    use HasFactory;

    protected $table = 'education_conversations';

    protected $fillable = [
        'education_user_id',
        'status',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | الطالب صاحب المحادثة
    |--------------------------------------------------------------------------
    */

    public function educationUser(): BelongsTo
    {
        return $this->belongsTo(
            EducationUser::class,
            'education_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | رسائل المحادثة
    |--------------------------------------------------------------------------
    */

    public function messages(): HasMany
    {
        return $this->hasMany(
            EducationMessage::class,
            'education_conversation_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | آخر رسالة
    |--------------------------------------------------------------------------
    */

    public function latestMessage()
    {
        return $this->hasOne(
            EducationMessage::class,
            'education_conversation_id'
        )->latestOfMany();
    }

    /*
    |--------------------------------------------------------------------------
    | Scope للمحادثات المفتوحة
    |--------------------------------------------------------------------------
    */

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope للمحادثات المغلقة
    |--------------------------------------------------------------------------
    */

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }
}
