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
        Schema::create('education_news', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | News Content
            |--------------------------------------------------------------------------
            */

            $table->string('title');
            $table->text('content')->nullable();

            /*
            |--------------------------------------------------------------------------
            | News Type
            |--------------------------------------------------------------------------
            |
            | announcement = إعلان
            | lesson      = درس جديد
            | update      = تحديث
            | notice      = تنبيه
            | general     = عام
            |
            */

            $table->string('type')->default('general');

            /*
            |--------------------------------------------------------------------------
            | Optional Link
            |--------------------------------------------------------------------------
            */

            $table->string('link')->nullable();
            $table->string('link_text')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Icon
            |--------------------------------------------------------------------------
            |
            | Example:
            | fa-solid fa-bell
            | fa-solid fa-book-open
            |
            */

            $table->string('icon')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Display Settings
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Scheduling
            |--------------------------------------------------------------------------
            */

            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('is_active');
            $table->index('type');
            $table->index('sort_order');
            $table->index(['starts_at', 'ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_news');
    }
};
