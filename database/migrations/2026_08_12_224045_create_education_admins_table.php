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
        Schema::create('education_admins', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | ADMIN INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('email')
                ->unique();

            $table->string('password');

            /*
            |--------------------------------------------------------------------------
            | AVATAR
            |--------------------------------------------------------------------------
            */

            $table->string('avatar')
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
            | REMEMBER TOKEN
            |--------------------------------------------------------------------------
            */

            $table->rememberToken();

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
        Schema::dropIfExists('education_admins');
    }
};
