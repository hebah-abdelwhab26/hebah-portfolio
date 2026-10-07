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
        Schema::create('education_settings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | BANK ACCOUNT
            |--------------------------------------------------------------------------
            */

            $table->string('bank_name')->nullable();

            $table->string('account_name')->nullable();

            $table->string('account_number')->nullable();

            $table->string('iban')->nullable();


            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            $table->boolean('payment_enabled')
                ->default(true);

            $table->text('payment_instructions')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_settings');
    }
};
