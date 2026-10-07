<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationQuiz extends Model
{
    use HasFactory;


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'education_quizzes';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'education_lesson_id',

        'education_student_lesson_id',

        'title',

        'description',

        'pass_percentage',

        'max_attempts',

        'time_limit',

        'is_active',

        'sort_order',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_lesson_id' => 'integer',

        'education_student_lesson_id' => 'integer',

        'pass_percentage' => 'integer',

        'max_attempts' => 'integer',

        'time_limit' => 'integer',

        'is_active' => 'boolean',

        'sort_order' => 'integer',

    ];


    /*
    |--------------------------------------------------------------------------
    | GENERAL LESSON
    |--------------------------------------------------------------------------
    |
    | الاختبار العام المرتبط بالدرس العام.
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
    | STUDENT LESSON
    |--------------------------------------------------------------------------
    |
    | هذه العلاقة موجودة للنظام الخاص بالطلاب فقط.
    |
    | لا نستخدمها في صفحة الموارد العامة.
    |
    */

    public function studentLesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationStudentLesson::class,
            'education_student_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | QUESTIONS
    |--------------------------------------------------------------------------
    */

    public function questions(): HasMany
    {
        return $this->hasMany(
            EducationQuizQuestion::class,
            'education_quiz_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | ATTEMPTS
    |--------------------------------------------------------------------------
    */

    public function attempts(): HasMany
    {
        return $this->hasMany(
            EducationQuizAttempt::class,
            'education_quiz_id'
        )
            ->latest('created_at');
    }


    /*
    |--------------------------------------------------------------------------
    | GENERAL QUIZ
    |--------------------------------------------------------------------------
    */

    public function isGeneral(): bool
    {
        return !is_null(
            $this->education_lesson_id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT QUIZ
    |--------------------------------------------------------------------------
    */

    public function isForStudent(): bool
    {
        return !is_null(
            $this->education_student_lesson_id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LESSON TYPE
    |--------------------------------------------------------------------------
    */

    public function getLessonTypeAttribute(): string
    {
        if ($this->isGeneral()) {
            return 'general';
        }

        if ($this->isForStudent()) {
            return 'student';
        }

        return 'none';
    }
}
