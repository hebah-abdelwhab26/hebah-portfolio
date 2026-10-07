<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationQuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_quiz_id',
        'question',
        'type',
        'points',
        'explanation',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
    | OPTIONS
    |--------------------------------------------------------------------------
    */

    public function options(): HasMany
    {
        return $this->hasMany(
            EducationQuizOption::class,
            'education_quiz_question_id'
        )->orderBy('sort_order');
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
            'education_quiz_question_id'
        );
    }
}
