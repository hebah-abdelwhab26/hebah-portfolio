<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | User Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();



            /*
            |--------------------------------------------------------------------------
            | Commentable Relation
            |--------------------------------------------------------------------------
            */

           $table->nullableMorphs('commentable');



            /*
            |--------------------------------------------------------------------------
            | Visitor Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('email')
                ->nullable();



            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            $table->text('message');



            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [

                'pending',
                'approved',
                'rejected'

            ])
            ->default('pending');



            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('comments');
    }

};
