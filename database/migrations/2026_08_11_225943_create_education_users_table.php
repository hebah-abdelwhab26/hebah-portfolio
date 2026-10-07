<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_users', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('locale', 5)
                ->default('ar');

            $table->string('email')
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | GOOGLE LOGIN
            |--------------------------------------------------------------------------
            */

            $table->string('google_id')
                ->nullable()
                ->unique();

            $table->string('password');

            $table->string('phone')
                ->nullable();

            $table->string('whatsapp_number')
                ->nullable();

            $table->boolean('whatsapp_reminders_enabled')
                ->default(false);

            $table->string('education_level')
                ->nullable();

            $table->text('learning_goal')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ACCOUNT STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | STUDENT APPROVAL STATUS
            |--------------------------------------------------------------------------
            |
            | pending  = الحساب مسجل ولم تتم الموافقة عليه كطالب بعد
            | approved = تمت الموافقة عليه كطالب
            | rejected = تم رفض طلب التسجيل كطالب
            |
            */

            $table->string('student_status')
                ->default('pending')
                ->after('is_active');

            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_users');
    }
};
