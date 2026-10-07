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
        Schema::create('education_availabilities', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | DAY
            |--------------------------------------------------------------------------
            |
            | 0 = Sunday
            | 1 = Monday
            | 2 = Tuesday
            | 3 = Wednesday
            | 4 = Thursday
            | 5 = Friday
            | 6 = Saturday
            |
            */

            $table->unsignedTinyInteger('day_of_week');


            /*
            |--------------------------------------------------------------------------
            | TIME
            |--------------------------------------------------------------------------
            */

            $table->time('start_time');

            $table->time('end_time');


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | OPTIONAL LABEL
            |--------------------------------------------------------------------------
            */

            $table->string('label')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | SORTING
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index([
                'day_of_week',
                'start_time',
                'is_active',
            ]);

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_availabilities');
    }
};
