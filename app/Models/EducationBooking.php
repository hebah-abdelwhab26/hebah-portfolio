<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EducationBooking extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'education_bookings';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        'education_user_id',

        /*
        |--------------------------------------------------------------------------
        | BOOKING TYPE
        |--------------------------------------------------------------------------
        */

        'education_booking_type_id',

        /*
        |--------------------------------------------------------------------------
        | BOOKING SNAPSHOT
        |--------------------------------------------------------------------------
        */

        'title',
        'description',

        /*
        |--------------------------------------------------------------------------
        | SESSIONS
        |--------------------------------------------------------------------------
        */

        'total_sessions',
        'completed_sessions',

        /*
        |--------------------------------------------------------------------------
        | PRICE
        |--------------------------------------------------------------------------
        */

        'price',
        'currency',

        /*
        |--------------------------------------------------------------------------
        | BOOKING DATE & TIME
        |--------------------------------------------------------------------------
        */

        'booking_date',
        'start_time',
        'end_time',

        /*
        |--------------------------------------------------------------------------
        | PAYMENT
        |--------------------------------------------------------------------------
        */

        'payment_status',
        'payment_method',
        'payment_reference',
        'paid_at',

        /*
        |--------------------------------------------------------------------------
        | BOOKING STATUS
        |--------------------------------------------------------------------------
        */

        'status',

        /*
        |--------------------------------------------------------------------------
        | NOTES
        |--------------------------------------------------------------------------
        */

        'student_note',
        'admin_note',

        /*
        |--------------------------------------------------------------------------
        | REMINDER
        |--------------------------------------------------------------------------
        */

        'reminder_sent',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_user_id' => 'integer',

        'education_booking_type_id' => 'integer',

        'total_sessions' => 'integer',

        'completed_sessions' => 'integer',

        'price' => 'decimal:2',

        'booking_date' => 'date',

        'start_time' => 'datetime:H:i',

        'end_time' => 'datetime:H:i',

        'paid_at' => 'datetime',

        'reminder_sent' => 'boolean',
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
    | BOOKING TYPE
    |--------------------------------------------------------------------------
    */

    public function bookingType(): BelongsTo
    {
        return $this->belongsTo(
            EducationBookingType::class,
            'education_booking_type_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    public function payment(): HasOne
    {
        return $this->hasOne(
            EducationBookingPayment::class,
            'education_booking_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LESSON ASSIGNMENTS
    |--------------------------------------------------------------------------
    |
    | الإسنادات المرتبطة بهذا الحجز.
    |
    */

    public function lessonAssignments(): HasMany
    {
        return $this->hasMany(
            EducationLessonAssignment::class,
            'education_booking_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS
    |--------------------------------------------------------------------------
    |
    | الدروس الخاصة بالطالب الناتجة عن هذا الحجز.
    |
    */

    public function studentLessons(): HasMany
    {
        return $this->hasMany(
            EducationStudentLesson::class,
            'education_booking_id'
        )
            ->orderBy('session_number')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | ACTIVE STUDENT LESSONS
    |--------------------------------------------------------------------------
    */

    public function activeStudentLessons(): HasMany
    {
        return $this->hasMany(
            EducationStudentLesson::class,
            'education_booking_id'
        )
            ->where('is_active', true)
            ->orderBy('session_number')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETED STUDENT LESSONS
    |--------------------------------------------------------------------------
    */

    public function completedStudentLessons(): HasMany
    {
        return $this->hasMany(
            EducationStudentLesson::class,
            'education_booking_id'
        )
            ->where('status', 'completed')
            ->orderBy('session_number')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | REMAINING SESSIONS
    |--------------------------------------------------------------------------
    */

    public function getRemainingSessionsAttribute(): int
    {
        return max(
            0,
            (int) $this->total_sessions
            - (int) $this->completed_sessions
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HAS REMAINING SESSIONS
    |--------------------------------------------------------------------------
    */

    public function hasRemainingSessions(): bool
    {
        return $this->remaining_sessions > 0;
    }


    /*
    |--------------------------------------------------------------------------
    | PACKAGE CHECK
    |--------------------------------------------------------------------------
    */

    public function isPackage(): bool
    {
        return (int) $this->total_sessions > 1;
    }


    /*
    |--------------------------------------------------------------------------
    | SINGLE LESSON CHECK
    |--------------------------------------------------------------------------
    */

    public function isSingleLesson(): bool
    {
        return (int) $this->total_sessions === 1;
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS EXIST
    |--------------------------------------------------------------------------
    */

    public function hasStudentLessons(): bool
    {
        return $this->studentLessons()->exists();
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS COUNT
    |--------------------------------------------------------------------------
    */

    public function getStudentLessonsCountAttribute(): int
    {
        return $this->studentLessons()->count();
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETED STUDENT LESSONS COUNT
    |--------------------------------------------------------------------------
    */

    public function getCompletedStudentLessonsCountAttribute(): int
    {
        return $this->studentLessons()
            ->where('status', 'completed')
            ->count();
    }


    /*
    |--------------------------------------------------------------------------
    | ALL STUDENT LESSONS COMPLETED
    |--------------------------------------------------------------------------
    */

    public function allStudentLessonsCompleted(): bool
    {
        $total = $this->studentLessons()->count();

        if ($total === 0) {
            return false;
        }

        return $this->studentLessons()
            ->where('status', '!=', 'completed')
            ->count() === 0;
    }
}
