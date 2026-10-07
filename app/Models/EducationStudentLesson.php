<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EducationStudentLesson extends Model
{
    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'education_student_lessons';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'education_user_id',

        'education_lesson_assignment_id',

        'education_booking_id',

        'source_lesson_id',

        'session_number',

        'title',

        'description',

        'status',

        'assigned_at',

        'started_at',

        'completed_at',

        'notes',

        'is_active',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_user_id' =>
            'integer',

        'education_lesson_assignment_id' =>
            'integer',

        'education_booking_id' =>
            'integer',

        'source_lesson_id' =>
            'integer',

        'session_number' =>
            'integer',

        'assigned_at' =>
            'datetime',

        'started_at' =>
            'datetime',

        'completed_at' =>
            'datetime',

        'is_active' =>
            'boolean',
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
    | ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(
            EducationLessonAssignment::class,
            'education_lesson_assignment_id'
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
    | SOURCE LESSON
    |--------------------------------------------------------------------------
    |
    | الدرس العام الذي أُنشئت منه هذه النسخة.
    |
    | يمكن أن يكون NULL.
    |
    | هذه العلاقة لا تُستخدم لتحديد اختبارات درس الطالب.
    |
    */

    public function sourceLesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationLesson::class,
            'source_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CONTENTS
    |--------------------------------------------------------------------------
    */

    public function contents(): HasMany
    {
        return $this->hasMany(
            EducationStudentLessonContent::class,
            'education_student_lesson_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | QUIZZES
    |--------------------------------------------------------------------------
    |
    | الاختبارات الخاصة بهذا الدرس للطالب.
    |
    | الاختبار مرتبط مباشرة بـ:
    |
    | education_student_lessons
    |
    | ولا يتم جلبه من الدرس العام.
    |
    */

    public function quizzes(): HasMany
    {
        return $this->hasMany(
            EducationQuiz::class,
            'education_student_lesson_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | EVALUATION
    |--------------------------------------------------------------------------
    */

    public function evaluation(): HasOne
    {
        return $this->hasOne(
            EducationLessonEvaluation::class,
            'education_student_lesson_id'
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
