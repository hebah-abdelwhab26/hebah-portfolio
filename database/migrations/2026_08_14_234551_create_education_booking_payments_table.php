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
        Schema::create('education_booking_payments', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            |
            | كل عملية دفع مرتبطة بحجز تعليمي واحد.
            |
            */

            $table->foreignId('education_booking_id')
    ->unique()
    ->constrained('education_bookings')
    ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | PAYMENT INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 10, 2);

            $table->string('currency', 3)
                ->default('SAR');

            $table->string('payment_method')
                ->nullable();

            $table->string('payment_reference')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | PAYMENT STATUS
            |--------------------------------------------------------------------------
            |
            | unpaid:
            | لم يتم إرسال الدفع.
            |
            | submitted:
            | الطالب أرسل إثبات الدفع.
            |
            | under_review:
            | الإثبات قيد المراجعة من الإدارة.
            |
            | approved:
            | تم قبول الدفع.
            |
            | rejected:
            | تم رفض الإثبات.
            |
            */

            $table->enum('status', [
                'unpaid',
                'submitted',
                'under_review',
                'approved',
                'rejected',
            ])->default('unpaid');


            /*
            |--------------------------------------------------------------------------
            | PAYMENT PROOF
            |--------------------------------------------------------------------------
            */

            $table->string('receipt_file')
                ->nullable();

            $table->string('receipt_original_name')
                ->nullable();

            $table->string('receipt_mime_type')
                ->nullable();

            $table->unsignedBigInteger('receipt_file_size')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | STUDENT SUBMISSION
            |--------------------------------------------------------------------------
            */

            $table->text('student_note')
                ->nullable();

            $table->timestamp('submitted_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | ADMIN REVIEW
            |--------------------------------------------------------------------------
            */

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('education_admins')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')
                ->nullable();

            $table->text('admin_note')
                ->nullable();

            $table->text('rejection_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | PAID INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->timestamp('paid_at')
                ->nullable();


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

            $table->index('education_booking_id');

            $table->index('status');

            $table->index('payment_reference');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_booking_payments');
    }
};
