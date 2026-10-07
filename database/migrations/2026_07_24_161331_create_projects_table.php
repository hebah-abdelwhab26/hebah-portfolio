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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('project_category_id')
                  ->constrained('project_categories')
                  ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('subtitle')->nullable();

            $table->text('short_description');

            $table->longText('description');

            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            $table->string('cover_image');

            $table->string('thumbnail')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Links
            |--------------------------------------------------------------------------
            */

            $table->string('live_demo')->nullable();

            $table->string('github')->nullable();

            $table->string('figma')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Project Information
            |--------------------------------------------------------------------------
            */

            $table->string('client')->nullable();

            $table->date('project_date')->nullable();

            $table->string('duration')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->enum('status', [

                'draft',

                'published',

            ])->default('draft');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
