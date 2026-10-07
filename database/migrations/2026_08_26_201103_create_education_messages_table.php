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
        Schema::create('education_messages', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | المحادثة
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_conversation_id')
                ->constrained('education_conversations')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | مرسل الرسالة
            |--------------------------------------------------------------------------
            |
            | يمكن أن يكون:
            |
            | education_user
            | education_admin
            |
            */

            $table->string('sender_type');

            $table->unsignedBigInteger('sender_id');

            /*
            |--------------------------------------------------------------------------
            | محتوى الرسالة
            |--------------------------------------------------------------------------
            */

            $table->text('message')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | المرفق
            |--------------------------------------------------------------------------
            |
            | نتركه nullable حتى تكون الرسالة نصية أو تحتوي على مرفق.
            |
            */

            $table->string('attachment')
                ->nullable();

            $table->string('attachment_name')
                ->nullable();

            $table->string('attachment_type')
                ->nullable();

            $table->unsignedBigInteger('attachment_size')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | قراءة الرسالة
            |--------------------------------------------------------------------------
            |
            | null    = لم تُقرأ
            | datetime = تمت القراءة
            |
            */

            $table->timestamp('read_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(
                ['education_conversation_id', 'created_at'],
                'education_messages_conversation_created_index'
            );

            $table->index(
                ['sender_type', 'sender_id'],
                'education_messages_sender_index'
            );

            $table->index('read_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_messages');
    }
};
