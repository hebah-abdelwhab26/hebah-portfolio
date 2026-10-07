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
        Schema::create('conversation_messages', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Conversation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('conversation_id')
                ->constrained('conversations')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            |
            | If the sender is a registered user, this points to users.id.
            | For admin messages this can remain null.
            |
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Sender Type
            |--------------------------------------------------------------------------
            |
            | user  = Message sent by website user
            | admin = Message sent by admin
            |
            */

            $table->enum('sender_type', [
                'user',
                'admin',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Sender Information
            |--------------------------------------------------------------------------
            |
            | We store a snapshot of sender information so old messages
            | remain understandable even if the user changes their name
            | or email later.
            |
            */

            $table->string('sender_name');

            $table->string('sender_email')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Message Content
            |--------------------------------------------------------------------------
            */

            $table->text('message');


            /*
            |--------------------------------------------------------------------------
            | Read Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_read')
                ->default(false);

            $table->timestamp('read_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'conversation_id',
                'created_at',
            ]);

            $table->index([
                'sender_type',
                'is_read',
            ]);
        });
    }


    /**
     * ==========================================
     * Reverse the migrations.
     * ==========================================
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_messages');
    }
};
