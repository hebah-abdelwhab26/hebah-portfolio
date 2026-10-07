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
        Schema::create('education_student_lesson_contents', function (Blueprint $table) {

            $table->id();
            

$table->foreignId('education_student_lesson_id');

$table->foreign(
    'education_student_lesson_id',
    'student_lesson_contents_lesson_fk'
)
->references('id')
->on('education_student_lessons')
->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | SOURCE CONTENT
            |--------------------------------------------------------------------------
            |
            | إذا تم إنشاء هذا المحتوى عن طريق نسخ محتوى عام،
            | نحتفظ بمعرف المحتوى الأصلي فقط لمعرفة المصدر.
            |
            | هذا لا يجعل المحتوى مشتركًا.
            |
            */

            $table->foreignId('source_content_id')
                ->nullable()
                ->constrained('education_lesson_contents')
                ->nullOnDelete();


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

            $table->string('title')
                ->nullable();

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TEXT CONTENT
            |--------------------------------------------------------------------------
            */

            $table->longText('content')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | URL
            |--------------------------------------------------------------------------
            */

            $table->text('url')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | FILE / IMAGE
            |--------------------------------------------------------------------------
            */

            $table->string('file_path')
                ->nullable();

            $table->string('file_name')
                ->nullable();

            $table->string('mime_type')
                ->nullable();

            $table->unsignedBigInteger('file_size')
                ->nullable();


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

            $table->index(
                [
                    'education_student_lesson_id',
                    'type',
                ],
                'student_lesson_contents_lesson_type_idx'
            );

            $table->index(
                [
                    'education_student_lesson_id',
                    'sort_order',
                ],
                'student_lesson_contents_lesson_order_idx'
            );

            $table->index('is_active');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'education_student_lesson_contents'
        );
    }
};
