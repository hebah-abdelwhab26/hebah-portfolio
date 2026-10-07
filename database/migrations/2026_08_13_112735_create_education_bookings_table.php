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
        Schema::create('education_bookings', function (Blueprint $table) {

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
            | BOOKING TYPE
            |--------------------------------------------------------------------------
            |
            | نوع الحجز:
            |
            | single  = حجز حصة واحدة
            | package = باقة / عدة حصص
            |
            */

            $table->foreignId('education_booking_type_id')
                ->constrained('education_booking_types')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | BOOKING SNAPSHOT
            |--------------------------------------------------------------------------
            |
            | نحتفظ بنسخة من بيانات نوع الحجز وقت إنشاء الحجز.
            | حتى لا تتأثر الحجوزات القديمة إذا تم تعديل النوع لاحقًا.
            |
            */

            $table->string('title');

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | PACKAGE INFORMATION
            |--------------------------------------------------------------------------
            |
            | للحجز الفردي:
            | total_sessions = 1
            |
            | للباقة:
            | مثلًا 8 حصص = 8
            |
            */

            $table->unsignedInteger('total_sessions')
                ->default(1);

            $table->unsignedInteger('completed_sessions')
                ->default(0);

                $table->unsignedInteger('session_duration')
    ->default(60);

            /*
            |--------------------------------------------------------------------------
            | PRICE SNAPSHOT
            |--------------------------------------------------------------------------
            */

            $table->decimal('price', 10, 2)
                ->default(0);

            $table->string('currency', 3)
                ->default('SAR');


            /*
            |--------------------------------------------------------------------------
            | BOOKING DATE
            |--------------------------------------------------------------------------
            |
            | في الحجز الفردي:
            | هذا هو موعد الحصة.
            |
            | في الباقة:
            | يمكن أن يكون تاريخ بداية الحجز.
            |
            */

            $table->date('booking_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TIME
            |--------------------------------------------------------------------------
            |
            | الحجز الفردي يحتاج وقتًا محددًا.
            |
            | الباقة يمكن أن تبدأ بدون تحديد وقت ثابت
            | إذا كانت الحصص ستُحدد لاحقًا.
            |
            */

            $table->time('start_time')
                ->nullable();

            $table->time('end_time')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            $table->enum('payment_status', [
                'unpaid',
                'pending',
                'paid',
                'failed',
                'refunded',
            ])->default('unpaid');

            $table->string('payment_method')
                ->nullable();

            $table->string('payment_reference')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | BOOKING STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled',
                'no_show',
            ])->default('pending');


            /*
            |--------------------------------------------------------------------------
            | NOTES
            |--------------------------------------------------------------------------
            */

            $table->text('student_note')
                ->nullable();

            $table->text('admin_note')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | REMINDER
            |--------------------------------------------------------------------------
            */

            $table->boolean('reminder_sent')
                ->default(false);


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

            $table->index([
                'education_user_id',
                'status',
            ]);

            $table->index([
                'booking_date',
                'start_time',
            ]);

            $table->index('education_booking_type_id');

            $table->index('payment_status');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('education_bookings');

        Schema::enableForeignKeyConstraints();
    }
};
