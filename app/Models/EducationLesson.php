<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationLesson extends Model
{
    protected $table = 'education_lessons';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'title',

        'slug',

        'category',

        'description',

        'duration',

        'price',

        'currency',

        'is_active',

        'sort_order',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'duration' => 'integer',

        'price' => 'decimal:2',

        'is_active' => 'boolean',

        'sort_order' => 'integer',

    ];


    /*
    |--------------------------------------------------------------------------
    | BOOKINGS
    |--------------------------------------------------------------------------
    */

    public function bookings(): HasMany
    {
        return $this->hasMany(
            EducationBooking::class,
            'education_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CONTENTS
    |--------------------------------------------------------------------------
    |
    | المحتوى العام للدرس.
    |
    */

    public function contents(): HasMany
    {
        return $this->hasMany(
            EducationLessonContent::class,
            'education_lesson_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | GENERAL QUIZZES
    |--------------------------------------------------------------------------
    |
    | الاختبارات العامة الخاصة بهذا الدرس.
    |
    | مهم:
    |
    | هذه العلاقة تخص الدرس العام فقط.
    | لا علاقة لها بـ EducationStudentLesson.
    |
    */

    public function quizzes(): HasMany
    {
        return $this->hasMany(
            EducationQuiz::class,
            'education_lesson_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT ASSIGNMENTS
    |--------------------------------------------------------------------------
    */

    public function assignments(): HasMany
    {
        return $this->hasMany(
            EducationLessonAssignment::class,
            'education_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS
    |--------------------------------------------------------------------------
    |
    | النسخ الخاصة بالطلاب التي تم إنشاؤها من هذا الدرس العام.
    |
    */

    public function studentLessons(): HasMany
    {
        return $this->hasMany(
            EducationStudentLesson::class,
            'source_lesson_id'
        );
    }
}
