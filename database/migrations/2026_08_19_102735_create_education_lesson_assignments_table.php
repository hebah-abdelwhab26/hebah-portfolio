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
        Schema::create('education_lesson_assignments', function (Blueprint $table) {

            $table->id();


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
            | LESSON
            |--------------------------------------------------------------------------
            |
            | هذا الحقل اختياري.
            |
            | إذا كان التعيين مبنيًا على درس عام من education_lessons
            | يتم تخزين رقم الدرس هنا.
            |
            | أما إذا كان الدرس خاصًا بالطالب وتم إنشاؤه مباشرة
            | من خلال EducationStudentLesson فلا يوجد درس عام مرتبط،
            | وبالتالي تكون القيمة NULL.
            |
            */

            $table->foreignId('education_lesson_id')
                ->nullable()
                ->constrained('education_lessons')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            |
            | يمكن ربط التعيين بالحجز الذي تم من خلاله إعطاء الدرس.
            |
            */

            $table->foreignId('education_booking_id')
                ->nullable()
                ->constrained('education_bookings')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'assigned',
                'in_progress',
                'completed',
            ])->default('assigned');


            /*
            |--------------------------------------------------------------------------
            | DATES
            |--------------------------------------------------------------------------
            */

            $table->timestamp('assigned_at')
                ->nullable();

            $table->timestamp('started_at')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | NOTES
            |--------------------------------------------------------------------------
            */

            $table->text('notes')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | ACTIVE
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


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
            |
            | Short custom names are used to avoid MySQL's identifier
            | length limitation.
            |
            */

            $table->index(
                [
                    'education_user_id',
                    'education_lesson_id',
                ],
                'lesson_assign_student_lesson_idx'
            );

            $table->index(
                [
                    'education_user_id',
                    'status',
                ],
                'lesson_assign_student_status_idx'
            );

            $table->index(
                [
                    'education_lesson_id',
                    'status',
                ],
                'lesson_assign_lesson_status_idx'
            );

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_lesson_assignments');
    }
};
