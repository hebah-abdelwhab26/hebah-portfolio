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
        Schema::create('education_student_lessons', function (Blueprint $table) {

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
            | ASSIGNMENT
            |--------------------------------------------------------------------------
            |
            | الحصة الخاصة ناتجة عن عملية إسناد.
            |
            */

            $table->foreignId('education_lesson_assignment_id')
                ->constrained('education_lesson_assignments')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            |
            | الحجز الذي تنتمي إليه الحصة.
            |
            */

            $table->foreignId('education_booking_id')
                ->nullable()
                ->constrained('education_bookings')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | SOURCE LESSON
            |--------------------------------------------------------------------------
            |
            | الدرس العام الذي تم إنشاء الحصة منه.
            |
            | هذا مجرد مرجع للمصدر.
            |
            | محتوى الحصة لا يعتمد عليه.
            |
            */

            $table->foreignId('source_lesson_id')
                ->nullable()
                ->constrained('education_lessons')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | SESSION
            |--------------------------------------------------------------------------
            |
            | رقم الحصة داخل الحجز / الباقة.
            |
            */

            $table->unsignedInteger('session_number')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | LESSON SNAPSHOT
            |--------------------------------------------------------------------------
            |
            | نسخة مستقلة من المعلومات الأساسية وقت إنشاء الحصة.
            |
            */

            $table->string('title');

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'assigned',
                'in_progress',
                'completed',
                'cancelled',
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
            |
            | ملاحظات داخلية خاصة بهذه الحصة.
            |
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


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'education_user_id',
                    'status',
                ],
                'student_lessons_user_status_idx'
            );

            $table->index(
                [
                    'education_booking_id',
                    'session_number',
                ],
                'student_lessons_booking_session_idx'
            );

            $table->index(
                [
                    'source_lesson_id',
                    'education_user_id',
                ],
                'student_lessons_source_user_idx'
            );

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_student_lessons');
    }
};
