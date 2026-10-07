<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationQuizOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_quiz_question_id',
        'option',
        'is_correct',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'is_active' => 'boolean',
    ];

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
    | ANSWERS
    |--------------------------------------------------------------------------
    */

    public function answers(): HasMany
    {
        return $this->hasMany(
            EducationQuizAnswer::class,
            'education_quiz_option_id'
        );
    }
}
