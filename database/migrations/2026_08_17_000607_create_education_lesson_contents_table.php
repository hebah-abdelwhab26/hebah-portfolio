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
        Schema::create('education_lesson_contents', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | LESSON
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_lesson_id')
                ->constrained('education_lessons')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | CONTENT TYPE
            |--------------------------------------------------------------------------
            |
            | text
            | image
            | link
            | file
            |
            */

            $table->string('type', 20);


            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('title')->nullable();

            $table->text('description')->nullable();


            /*
            |--------------------------------------------------------------------------
            | TEXT CONTENT
            |--------------------------------------------------------------------------
            |
            | يستخدم عندما يكون type = text
            |
            */

            $table->longText('content')->nullable();


            /*
            |--------------------------------------------------------------------------
            | URL
            |--------------------------------------------------------------------------
            |
            | يستخدم للروابط مثل:
            | YouTube
            | Zoom
            | Google Drive
            | وغيرها
            |
            */

            $table->text('url')->nullable();


            /*
            |--------------------------------------------------------------------------
            | FILE / IMAGE
            |--------------------------------------------------------------------------
            |
            | نحفظ المسار داخل public/images أو public/files
            | حسب نوع المحتوى.
            |
            */

            $table->string('file_path')->nullable();


            /*
            |--------------------------------------------------------------------------
            | FILE NAME
            |--------------------------------------------------------------------------
            |
            | الاسم الذي يظهر للمستخدم.
            |
            */

            $table->string('file_name')->nullable();


            /*
            |--------------------------------------------------------------------------
            | FILE TYPE
            |--------------------------------------------------------------------------
            |
            | مثال:
            | pdf
            | docx
            | jpg
            | png
            |
            */

            $table->string('mime_type')->nullable();


            /*
            |--------------------------------------------------------------------------
            | FILE SIZE
            |--------------------------------------------------------------------------
            |
            | بالـ bytes
            |
            */

            $table->unsignedBigInteger('file_size')->nullable();


            /*
            |--------------------------------------------------------------------------
            | SORT ORDER
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEXES
            |--------------------------------------------------------------------------
            */

            $table->index([
                'education_lesson_id',
                'type'
            ]);

            $table->index([
                'education_lesson_id',
                'sort_order'
            ]);

            $table->index('is_active');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'education_lesson_contents'
        );
    }
};
