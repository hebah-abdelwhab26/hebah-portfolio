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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();

            // بيانات المرسل
            $table->string('name');
            $table->string('email');

            // نوع الاستفسار
            $table->string('subject');

            // نص الرسالة
            $table->text('message');

            // مصدر الرسالة
            // digital_studio = قسم البرمجة
            // education = قسم التعليم
            $table->string('source')
                ->default('digital_studio');

            // حالة الرسالة
            $table->enum('status', [
                'new',
                'read',
                'replied',
            ])->default('new');

            // تاريخ قراءة الرسالة
            $table->timestamp('read_at')->nullable();

            // تاريخ الرد على الرسالة
            $table->timestamp('replied_at')->nullable();

            $table->timestamps();

            // لتحسين البحث والترتيب في لوحة الإدارة
            $table->index('status');
            $table->index('email');
            $table->index('source');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
