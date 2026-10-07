<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationLessonEvaluation extends Model
{
    protected $table = 'education_lesson_evaluations';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'education_student_lesson_id',

        'attendance_status',

        'understanding_score',

        'performance_score',

        'memorization_score',

        'tajweed_score',

        'score',

        'max_score',

        'teacher_notes',

        'student_feedback',

        'evaluated_at',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_student_lesson_id' => 'integer',

        'understanding_score' => 'integer',

        'performance_score' => 'integer',

        'memorization_score' => 'integer',

        'tajweed_score' => 'integer',

        'score' => 'decimal:2',

        'max_score' => 'decimal:2',

        'evaluated_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSON
    |--------------------------------------------------------------------------
    */

    public function studentLesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationStudentLesson::class,
            'education_student_lesson_id'
        );
    }
}
