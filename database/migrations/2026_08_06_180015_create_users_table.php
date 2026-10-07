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
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('username')
                ->unique();

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

            $table->string('phone')
                ->nullable();

            $table->string('avatar')
                ->nullable();

            $table->text('bio')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ACCOUNT
            |--------------------------------------------------------------------------
            */

            $table->enum('role', [
                'super_admin',
                'admin',
                'editor',
                'user'
            ])->default('user');

            $table->enum('status', [
                'active',
                'inactive',
                'blocked'
            ])->default('active');

            /*
            |--------------------------------------------------------------------------
            | SECURITY
            |--------------------------------------------------------------------------
            */

            $table->timestamp('email_verified_at')
                ->nullable();

            $table->timestamp('last_login_at')
                ->nullable();

            $table->string('password');

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
        Schema::dropIfExists('users');
    }
};
