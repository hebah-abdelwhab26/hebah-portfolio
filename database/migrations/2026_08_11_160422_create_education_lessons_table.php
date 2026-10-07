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
        Schema::create('education_lessons', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('category')->nullable();

            $table->text('description')->nullable();


            /*
            |--------------------------------------------------------------------------
            | LESSON SETTINGS
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('duration')->default(60);

            $table->decimal('price', 10, 2)->default(0);

            $table->string('currency', 3)->default('SAR');


            /*
            |--------------------------------------------------------------------------
            | STATUS / ORDER
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_lessons');
    }
};
