<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationQuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_quiz_attempt_id',
        'education_quiz_question_id',
        'education_quiz_option_id',
        'answer_text',
        'is_correct',
        'points_earned',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | ATTEMPT
    |--------------------------------------------------------------------------
    */

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(
            EducationQuizAttempt::class,
            'education_quiz_attempt_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | QUESTION
    |--------------------------------------------------------------------------
    */

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            EducationQuizQuestion::class,
            'education_quiz_question_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SELECTED OPTION
    |--------------------------------------------------------------------------
    */

    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(
            EducationQuizOption::class,
            'education_quiz_option_id'
        );
    }
}
