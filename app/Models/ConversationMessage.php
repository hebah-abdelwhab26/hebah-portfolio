<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationMessage extends Model
{
    use HasFactory;

    /**
     * ==========================================
     * Table
     * ==========================================
     */

    protected $table = 'conversation_messages';


    /**
     * ==========================================
     * Mass Assignment
     * ==========================================
     */

    protected $fillable = [
        'conversation_id',
        'user_id',
        'sender_type',
        'sender_name',
        'sender_email',
        'message',
        'is_read',
        'read_at',
    ];


    /**
     * ==========================================
     * Attribute Casting
     * ==========================================
     */

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];


    /**
     * ==========================================
     * Conversation
     * ==========================================
     */

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(
            Conversation::class
        );
    }


    /**
     * ==========================================
     * User
     * ==========================================
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }


    /**
     * ==========================================
     * Is User Message
     * ==========================================
     */

    public function isUserMessage(): bool
    {
        return $this->sender_type === 'user';
    }


    /**
     * ==========================================
     * Is Admin Message
     * ==========================================
     */

    public function isAdminMessage(): bool
    {
        return $this->sender_type === 'admin';
    }


    /**
     * ==========================================
     * Mark As Read
     * ==========================================
     */

    public function markAsRead(): void
    {
        if (!$this->is_read) {

            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }


    /**
     * ==========================================
     * Scope: Unread
     * ==========================================
     */

    public function scopeUnread($query)
    {
        return $query->where(
            'is_read',
            false
        );
    }


    /**
     * ==========================================
     * Scope: User Messages
     * ==========================================
     */

    public function scopeFromUser($query)
    {
        return $query->where(
            'sender_type',
            'user'
        );
    }


    /**
     * ==========================================
     * Scope: Admin Messages
     * ==========================================
     */

    public function scopeFromAdmin($query)
    {
        return $query->where(
            'sender_type',
            'admin'
        );
    }
}
