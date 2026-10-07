<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('education_lesson_evaluations', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | STUDENT LESSON
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_student_lesson_id')
                ->constrained('education_student_lessons')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | ATTENDANCE
            |--------------------------------------------------------------------------
            */

            $table->enum('attendance_status', [
                'present',
                'late',
                'absent',
                'excused',
            ])->default('present');


            /*
            |--------------------------------------------------------------------------
            | SCORES
            |--------------------------------------------------------------------------
            |
            | يمكن للمعلم استخدام هذه الدرجات حسب نوع التعليم.
            |
            */

            $table->unsignedTinyInteger('understanding_score')
                ->nullable();

            $table->unsignedTinyInteger('performance_score')
                ->nullable();

            $table->unsignedTinyInteger('memorization_score')
                ->nullable();

            $table->unsignedTinyInteger('tajweed_score')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | GENERAL SCORE
            |--------------------------------------------------------------------------
            */

            $table->decimal('score', 5, 2)
                ->nullable();

            $table->decimal('max_score', 5, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TEACHER NOTES
            |--------------------------------------------------------------------------
            */

            $table->text('teacher_notes')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | STUDENT FEEDBACK
            |--------------------------------------------------------------------------
            */

            $table->text('student_feedback')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | EVALUATED AT
            |--------------------------------------------------------------------------
            */

            $table->timestamp('evaluated_at')
                ->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->unique(
                'education_student_lesson_id',
                'lesson_evaluations_student_lesson_unique'
            );

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'education_lesson_evaluations'
        );
    }
};
