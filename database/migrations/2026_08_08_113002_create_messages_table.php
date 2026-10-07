<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ==========================================
     * Run the migrations.
     * ==========================================
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

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
            | Sender Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('email');

            $table->string('phone')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Message Information
            |--------------------------------------------------------------------------
            */

            $table->string('subject');

            $table->text('message');


            /*
            |--------------------------------------------------------------------------
            | Message Status
            |--------------------------------------------------------------------------
            |
            | new      = Newly received message
            | read     = Message has been viewed
            | replied  = Admin has replied
            | archived = Message has been archived
            |
            */

            $table->enum('status', [
                'new',
                'read',
                'replied',
                'archived',
            ])->default('new');


            /*
            |--------------------------------------------------------------------------
            | Read Information
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_read')
                ->default(false);

            $table->timestamp('read_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Reply Information
            |--------------------------------------------------------------------------
            */

            $table->timestamp('replied_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }


    /**
     * ==========================================
     * Reverse the migrations.
     * ==========================================
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
