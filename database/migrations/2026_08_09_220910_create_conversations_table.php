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
        Schema::create('conversations', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            |
            | The user who owns this conversation.
            | Nullable so the conversation can still exist if the user
            | account is deleted.
            |
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Conversation Information
            |--------------------------------------------------------------------------
            */

            $table->string('subject');


            /*
            |--------------------------------------------------------------------------
            | Conversation Status
            |--------------------------------------------------------------------------
            |
            | open      = Conversation is active
            | closed    = Conversation has been closed
            | archived  = Conversation has been archived
            |
            */

            $table->enum('status', [
                'open',
                'closed',
                'archived',
            ])->default('open');


            /*
            |--------------------------------------------------------------------------
            | Last Message
            |--------------------------------------------------------------------------
            |
            | Used later for sorting conversations by latest activity.
            |
            */

            $table->timestamp('last_message_at')
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
        Schema::dropIfExists('conversations');
    }
};
