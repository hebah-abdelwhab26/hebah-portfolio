<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationQuizAttempt extends Model
{
    use HasFactory;

    protected $table = 'education_quiz_attempts';

    protected $fillable = [

        'education_quiz_id',

        'education_user_id',

        'score',

        'total_points',

        'percentage',

        'passed',

        'status',

        'started_at',

        'completed_at',

        'attempt_number',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_quiz_id' => 'integer',

        'education_user_id' => 'integer',

        'score' => 'integer',

        'total_points' => 'integer',

        'percentage' => 'decimal:2',

        'passed' => 'boolean',

        'attempt_number' => 'integer',

        'started_at' => 'datetime',

        'completed_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | QUIZ
    |--------------------------------------------------------------------------
    */

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(
            EducationQuiz::class,
            'education_quiz_id'
        );
    }


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
    | ANSWERS
    |--------------------------------------------------------------------------
    */

    public function answers(): HasMany
    {
        return $this->hasMany(
            EducationQuizAnswer::class,
            'education_quiz_attempt_id'
        );
    }
}
