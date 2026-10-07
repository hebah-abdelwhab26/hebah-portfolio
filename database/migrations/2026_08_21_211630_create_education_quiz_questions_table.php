<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_quiz_questions', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | QUIZ
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_quiz_id')
                ->constrained('education_quizzes')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | QUESTION
            |--------------------------------------------------------------------------
            */

            $table->text('question');


            /*
            |--------------------------------------------------------------------------
            | QUESTION TYPE
            |--------------------------------------------------------------------------
            |
            | حاليا ندعم:
            |
            | multiple_choice
            | true_false
            |
            | ويمكن إضافة أنواع أخرى لاحقا.
            |
            */

            $table->string('type')
                ->default('multiple_choice');


            /*
            |--------------------------------------------------------------------------
            | POINTS
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('points')
                ->default(1);


            /*
            |--------------------------------------------------------------------------
            | EXPLANATION
            |--------------------------------------------------------------------------
            |
            | تظهر للطالب بعد التقييم إذا أردنا ذلك.
            |
            */

            $table->text('explanation')
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
                'education_quiz_id',
                'is_active',
            ]);

            $table->index('sort_order');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('education_quiz_questions');
    }
};
