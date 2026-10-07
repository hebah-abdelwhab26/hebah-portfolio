<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('education_bookings', function (Blueprint $table) {
            $table->string('payment_status')
                ->default('unpaid')
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('education_bookings', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};
