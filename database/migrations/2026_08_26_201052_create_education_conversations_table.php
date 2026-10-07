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
        Schema::create('education_conversations', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | الطالب صاحب المحادثة
            |--------------------------------------------------------------------------
            */

            $table->foreignId('education_user_id')
                ->constrained('education_users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | حالة المحادثة
            |--------------------------------------------------------------------------
            |
            | open   = مفتوحة
            | closed = مغلقة
            |
            */

            $table->enum('status', [
                'open',
                'closed',
            ])->default('open');

            /*
            |--------------------------------------------------------------------------
            | آخر رسالة
            |--------------------------------------------------------------------------
            |
            | تستخدم لترتيب المحادثات حسب آخر نشاط.
            |
            */

            $table->timestamp('last_message_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('education_user_id');
            $table->index('status');
            $table->index('last_message_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_conversations');
    }
};
