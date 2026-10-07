<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    /**
     * ==========================================
     * Table
     * ==========================================
     */

    protected $table = 'conversations';


    /**
     * ==========================================
     * Mass Assignment
     * ==========================================
     */

    protected $fillable = [
        'user_id',
        'subject',
        'status',
        'last_message_at',
    ];


    /**
     * ==========================================
     * Attribute Casting
     * ==========================================
     */

    protected $casts = [
        'last_message_at' => 'datetime',
    ];


    /**
     * ==========================================
     * User
     * ==========================================
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * ==========================================
     * Messages
     * ==========================================
     */

    public function messages(): HasMany
    {
        return $this->hasMany(
            ConversationMessage::class
        );
    }


    /**
     * ==========================================
     * Latest Message
     * ==========================================
     */

    public function latestMessage()
    {
        return $this->hasOne(
            ConversationMessage::class
        )->latestOfMany();
    }


    /**
     * ==========================================
     * Open Conversation
     * ==========================================
     */

    public function scopeOpen($query)
    {
        return $query->where(
            'status',
            'open'
        );
    }


    /**
     * ==========================================
     * Closed Conversation
     * ==========================================
     */

    public function scopeClosed($query)
    {
        return $query->where(
            'status',
            'closed'
        );
    }


    /**
     * ==========================================
     * Archived Conversation
     * ==========================================
     */

    public function scopeArchived($query)
    {
        return $query->where(
            'status',
            'archived'
        );
    }


    /**
     * ==========================================
     * Close
     * ==========================================
     */

    public function close(): void
    {
        $this->update([
            'status' => 'closed',
        ]);
    }


    /**
     * ==========================================
     * Reopen
     * ==========================================
     */

    public function reopen(): void
    {
        $this->update([
            'status' => 'open',
        ]);
    }


    /**
     * ==========================================
     * Archive
     * ==========================================
     */

    public function archive(): void
    {
        $this->update([
            'status' => 'archived',
        ]);
    }
}
