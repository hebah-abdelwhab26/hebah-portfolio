<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationMessage extends Model
{
    use HasFactory;

    protected $table = 'education_messages';

    protected $fillable = [
        'education_conversation_id',
        'sender_type',
        'sender_id',
        'message',
        'attachment',
        'attachment_name',
        'attachment_type',
        'attachment_size',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | المحادثة
    |--------------------------------------------------------------------------
    */

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(
            EducationConversation::class,
            'education_conversation_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | هل الرسالة مقروءة؟
    |--------------------------------------------------------------------------
    */

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /*
    |--------------------------------------------------------------------------
    | هل الرسالة غير مقروءة؟
    |--------------------------------------------------------------------------
    */

    public function isUnread(): bool
    {
        return $this->read_at === null;
    }

    /*
    |--------------------------------------------------------------------------
    | اسم المرسل
    |--------------------------------------------------------------------------
    */

    public function getSenderNameAttribute(): string
    {
        if ($this->sender_type === 'education_user') {
            return EducationUser::find($this->sender_id)?->name ?? 'طالب';
        }

        if ($this->sender_type === 'education_admin') {
            return EducationAdmin::find($this->sender_id)?->name ?? 'الإدارة';
        }

        return 'مستخدم';
    }
}
