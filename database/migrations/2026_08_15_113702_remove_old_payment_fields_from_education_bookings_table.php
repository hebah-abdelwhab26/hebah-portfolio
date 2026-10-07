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
        /*
        |--------------------------------------------------------------------------
        | REMOVE OLD PAYMENT FIELDS
        |--------------------------------------------------------------------------
        |
        | نظام الدفع الحالي أصبح منفصلًا داخل:
        |
        | education_booking_payments
        |
        | لذلك نحذف حقول الدفع القديمة من education_bookings.
        |
        */

        if (! Schema::hasTable('education_bookings')) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | REMOVE OLD PAYMENT FOREIGN KEY
        |--------------------------------------------------------------------------
        |
        | لا نحاول حذف الـ Foreign Key إلا إذا كان موجودًا.
        |
        */

        if (Schema::hasColumn('education_bookings', 'payment_reviewed_by')) {

            Schema::table('education_bookings', function (Blueprint $table) {

                /*
                |--------------------------------------------------------------
                | DROP OLD FOREIGN KEY
                |--------------------------------------------------------------
                */

                try {
                    $table->dropForeign([
                        'payment_reviewed_by',
                    ]);
                } catch (\Throwable $e) {
                    /*
                    | الـ Foreign Key غير موجود.
                    | لا نوقف migrate:fresh.
                    */
                }

            });
        }


        /*
        |--------------------------------------------------------------------------
        | REMOVE OLD PAYMENT COLUMNS
        |--------------------------------------------------------------------------
        */

        $columnsToDrop = [

            'payment_status',

            'payment_method',

            'payment_reference',

            'payment_receipt',

            'payment_submitted_at',

            'payment_reviewed_by',

            'payment_reviewed_at',

            'payment_admin_note',

            'paid_at',

        ];


        /*
        |--------------------------------------------------------------------------
        | ONLY DROP EXISTING COLUMNS
        |--------------------------------------------------------------------------
        */

        $existingColumns = collect($columnsToDrop)
            ->filter(function ($column) {

                return Schema::hasColumn(
                    'education_bookings',
                    $column
                );

            })
            ->values()
            ->all();


        if (! empty($existingColumns)) {

            Schema::table('education_bookings', function (Blueprint $table) use ($existingColumns) {

                $table->dropColumn($existingColumns);

            });

        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | RESTORE OLD PAYMENT FIELDS
        |--------------------------------------------------------------------------
        */

        if (! Schema::hasTable('education_bookings')) {
            return;
        }


        Schema::table('education_bookings', function (Blueprint $table) {

            /*
            |----------------------------------------------------------------------
            | PAYMENT STATUS
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_status'
            )) {

                $table->enum('payment_status', [

                    'unpaid',

                    'pending',

                    'paid',

                    'failed',

                    'refunded',

                ])
                ->default('unpaid');

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT METHOD
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_method'
            )) {

                $table->string('payment_method')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT REFERENCE
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_reference'
            )) {

                $table->string('payment_reference')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT RECEIPT
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_receipt'
            )) {

                $table->string('payment_receipt')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT SUBMITTED AT
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_submitted_at'
            )) {

                $table->timestamp('payment_submitted_at')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT REVIEWED BY
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_reviewed_by'
            )) {

                $table->foreignId('payment_reviewed_by')
                    ->nullable()
                    ->constrained('education_admins')
                    ->nullOnDelete();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT REVIEWED AT
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_reviewed_at'
            )) {

                $table->timestamp('payment_reviewed_at')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAYMENT ADMIN NOTE
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'payment_admin_note'
            )) {

                $table->text('payment_admin_note')
                    ->nullable();

            }


            /*
            |----------------------------------------------------------------------
            | PAID AT
            |----------------------------------------------------------------------
            */

            if (! Schema::hasColumn(
                'education_bookings',
                'paid_at'
            )) {

                $table->timestamp('paid_at')
                    ->nullable();

            }

        });
    }
};
