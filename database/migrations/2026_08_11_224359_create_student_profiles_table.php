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
        Schema::create('student_profiles', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | PERSONAL INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('phone')->nullable();

            $table->string('whatsapp_number')->nullable();


            /*
            |--------------------------------------------------------------------------
            | WHATSAPP REMINDERS
            |--------------------------------------------------------------------------
            */

            $table->boolean('whatsapp_reminders_enabled')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | EDUCATION INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('education_level')->nullable();

            $table->text('learning_goal')->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
