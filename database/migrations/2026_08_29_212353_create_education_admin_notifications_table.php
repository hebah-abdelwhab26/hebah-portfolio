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
        Schema::create('education_admin_notifications', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_admin_id')
                ->constrained('education_admins')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | NOTIFICATION DATA
            |--------------------------------------------------------------------------
            */

            $table->string('type')->nullable();

            $table->string('title');

            $table->text('message')->nullable();

            $table->string('icon')->nullable();

            $table->string('color')->nullable();


            /*
            |--------------------------------------------------------------------------
            | OPTIONAL LINK
            |--------------------------------------------------------------------------
            */

            $table->string('url')->nullable();


            /*
            |--------------------------------------------------------------------------
            | READ STATUS
            |--------------------------------------------------------------------------
            */

            $table->timestamp('read_at')->nullable();


            /*
            |--------------------------------------------------------------------------
            | EXTRA DATA
            |--------------------------------------------------------------------------
            */

            $table->json('data')->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index(
                ['education_admin_id', 'read_at']
            );

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'education_admin_notifications'
        );
    }
};

