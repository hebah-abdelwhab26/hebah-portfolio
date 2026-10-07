<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_quiz_answers', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | ATTEMPT
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_quiz_attempt_id')
                ->constrained('education_quiz_attempts')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | QUESTION
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_quiz_question_id')
                ->constrained('education_quiz_questions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | SELECTED OPTION
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_quiz_option_id')
                ->nullable()
                ->constrained('education_quiz_options')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | ANSWER TEXT
            |--------------------------------------------------------------------------
            |
            | نحتاجه لاحقا إذا أضفنا:
            |
            | short_answer
            | essay
            |
            */

            $table->text('answer_text')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | RESULT
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_correct')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | POINTS
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('points_earned')
                ->default(0);


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(
    ['education_quiz_attempt_id', 'education_quiz_question_id'],
    'quiz_answers_attempt_question_idx'
);
            $table->index('is_correct');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('education_quiz_answers');
    }
};
