<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * =========================================================
     * TABLE
     * =========================================================
     */
    protected $table = 'contact_messages';

    /**
     * =========================================================
     * MASS ASSIGNMENT
     * =========================================================
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'source',
        'status',
        'read_at',
        'replied_at',
    ];

    /**
     * =========================================================
     * CASTS
     * =========================================================
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    /**
     * =========================================================
     * SCOPES
     * =========================================================
     */

    /**
     * الرسائل الجديدة فقط
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * الرسائل المقروءة
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * الرسائل التي تم الرد عليها
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * =========================================================
     * HELPERS
     * =========================================================
     */

    /**
     * تحديد الرسالة كمقروءة
     */
    public function markAsRead(): void
    {
        if ($this->status === 'new') {
            $this->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }
    }

    /**
     * تحديد الرسالة بأنه تم الرد عليها
     */
    public function markAsReplied(): void
    {
        $this->update([
            'status' => 'replied',
            'read_at' => $this->read_at ?? now(),
            'replied_at' => now(),
        ]);
    }

    /**
     * هل الرسالة جديدة؟
     */
    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    /**
     * هل الرسالة مقروءة؟
     */
    public function isRead(): bool
    {
        return $this->status === 'read';
    }

    /**
     * هل تم الرد عليها؟
     */
    public function isReplied(): bool
    {
        return $this->status === 'replied';
    }
}
