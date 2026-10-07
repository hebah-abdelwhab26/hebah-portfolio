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
        Schema::create('education_quizzes', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | GENERAL LESSON
            |--------------------------------------------------------------------------
            |
            | الاختبار يمكن أن يرتبط بدرس عام موجود في education_lessons.
            |
            | يكون NULL إذا كان الاختبار خاصًا بدرس طالب.
            |
            */

            $table->foreignId('education_lesson_id')
                ->nullable()
                ->constrained('education_lessons')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | STUDENT LESSON
            |--------------------------------------------------------------------------
            |
            | الاختبار يمكن أن يرتبط بدرس خاص بطالب موجود
            | في education_student_lessons.
            |
            | يكون NULL إذا كان الاختبار خاصًا بدرس عام.
            |
            */

            $table->foreignId('education_student_lesson_id')
                ->nullable()
                ->constrained('education_student_lessons')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | QUIZ SETTINGS
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('pass_percentage')
                ->default(60);

            $table->unsignedInteger('max_attempts')
                ->nullable();

            $table->unsignedInteger('time_limit')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | SORTING
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'education_lesson_id',
                    'is_active',
                ],
                'quiz_general_lesson_active_idx'
            );

            $table->index(
                [
                    'education_student_lesson_id',
                    'is_active',
                ],
                'quiz_student_lesson_active_idx'
            );

            $table->index(
                'sort_order',
                'quiz_sort_order_idx'
            );

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_quizzes');
    }
};
