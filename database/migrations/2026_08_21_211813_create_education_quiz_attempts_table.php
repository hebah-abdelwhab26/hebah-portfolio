<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_quiz_attempts', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | QUIZ
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_quiz_id')
                ->constrained('education_quizzes')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | STUDENT
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_user_id')
                ->constrained('education_users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | SCORE
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('score')
                ->default(0);

            $table->unsignedInteger('total_points')
                ->default(0);

            $table->decimal('percentage', 5, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | RESULT
            |--------------------------------------------------------------------------
            */

            $table->boolean('passed')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            |
            | in_progress
            | completed
            | abandoned
            |
            */

            $table->string('status')
                ->default('in_progress');


            /*
            |--------------------------------------------------------------------------
            | TIME
            |--------------------------------------------------------------------------
            */

            $table->timestamp('started_at')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | ATTEMPT NUMBER
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('attempt_number')
                ->default(1);


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'education_user_id',
                    'education_quiz_id',
                ],
                'quiz_attempts_user_quiz_idx'
            );

            $table->index(
                [
                    'education_user_id',
                    'status',
                ],
                'quiz_attempts_user_status_idx'
            );

            $table->index(
                'passed',
                'quiz_attempts_passed_idx'
            );
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('education_quiz_attempts');
    }
};
