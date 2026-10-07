<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * ==================================
     * Mass Assignment
     * ==================================
     */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        'user_id',

        /*
        |--------------------------------------------------------------------------
        | Visitor Information
        |--------------------------------------------------------------------------
        */

        'name',

        'email',

        /*
        |--------------------------------------------------------------------------
        | Comment Content
        |--------------------------------------------------------------------------
        */

        'message',

        /*
        |--------------------------------------------------------------------------
        | Polymorphic Relation
        |--------------------------------------------------------------------------
        */

        'commentable_id',

        'commentable_type',

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        'status',

    ];

    /**
     * ==================================
     * Attribute Casting
     * ==================================
     */

    protected $casts = [

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Registered User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Commentable Model
     *
     * Project or any future model.
     */
  public function commentable()
{
    return $this->morphTo()->withDefault();
}

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Approved Comments
     */
    public function scopeApproved($query)
    {
        return $query->where(
            'status',
            'approved'
        );
    }

    /**
     * Pending Comments
     */
    public function scopePending($query)
    {
        return $query->where(
            'status',
            'pending'
        );
    }

    /**
     * Rejected Comments
     */
    public function scopeRejected($query)
    {
        return $query->where(
            'status',
            'rejected'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Status Label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
                        'approved' => 'Approved',

            'pending' => 'Pending',

            'rejected' => 'Rejected',

            default => 'Unknown',

        };
    }

    /**
     * Status Badge Color
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {

            'approved' => 'success',

            'pending' => 'warning',

            'rejected' => 'danger',

            default => 'secondary',

        };
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if comment is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if comment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if comment is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
