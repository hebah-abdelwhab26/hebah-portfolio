<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_quiz_options', function (Blueprint $table) {

            $table->id();


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
            | OPTION
            |--------------------------------------------------------------------------
            */

            $table->text('option');


            /*
            |--------------------------------------------------------------------------
            | CORRECT ANSWER
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_correct')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | SORTING
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

           $table->index(
    [
        'education_quiz_question_id',
        'is_correct',
    ],
    'quiz_opt_q_correct_idx'
);

            $table->index('sort_order');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('education_quiz_options');
    }
};
