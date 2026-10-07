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
        Schema::create('digital_studio_news', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('content')->nullable();

            $table->string('type')->default('general');

            $table->string('link')->nullable();

            $table->string('link_text')->nullable();

            $table->string('icon')->nullable();

            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamp('starts_at')->nullable();

            $table->timestamp('ends_at')->nullable();

            $table->timestamps();

            $table->index('type');
            $table->index('is_active');
            $table->index('sort_order');
            $table->index('starts_at');
            $table->index('ends_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_studio_news');
    }
};
