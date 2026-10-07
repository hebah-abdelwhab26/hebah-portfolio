<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EducationLessonAssignment extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'education_lesson_assignments';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Student
        'education_user_id',

        // Optional public/general lesson
        'education_lesson_id',

        // Booking / Package
        'education_booking_id',

        // Status
        'status',

        // Dates
        'assigned_at',
        'started_at',
        'completed_at',

        // Notes
        'notes',

        // Active
        'is_active',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_user_id' => 'integer',

        'education_lesson_id' => 'integer',

        'education_booking_id' => 'integer',

        'assigned_at' => 'datetime',

        'started_at' => 'datetime',

        'completed_at' => 'datetime',

        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            EducationUser::class,
            'education_user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERAL LESSON
    |--------------------------------------------------------------------------
    |
    | اختياري.
    |
    | إذا كان الإسناد مبنيًا على درس عام يكون موجودًا.
    |
    | أما دروس الباقات الخاصة بالطالب فيمكن أن يكون NULL.
    |
    */

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationLesson::class,
            'education_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    public function booking(): BelongsTo
    {
        return $this->belongsTo(
            EducationBooking::class,
            'education_booking_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSON
    |--------------------------------------------------------------------------
    |
    | الدرس الفعلي الخاص بالطالب.
    |
    */

    public function studentLesson(): HasOne
    {
        return $this->hasOne(
            EducationStudentLesson::class,
            'education_lesson_assignment_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS HELPERS
    |--------------------------------------------------------------------------
    */

    public function isAssigned(): bool
    {
        return $this->status === 'assigned';
    }


    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }


    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }


    /*
    |--------------------------------------------------------------------------
    | START
    |--------------------------------------------------------------------------
    */

    public function start(): void
    {
        if (!$this->started_at) {
            $this->started_at = now();
        }

        $this->status = 'in_progress';

        $this->save();
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    public function complete(): void
    {
        $this->status = 'completed';

        $this->completed_at = now();

        $this->save();
    }
}
