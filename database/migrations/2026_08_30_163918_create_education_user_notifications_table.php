<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_user_notifications', function (Blueprint $table) {

            $table->id();

            $table->foreignId('education_user_id')
                ->constrained('education_users')
                ->cascadeOnDelete();

            $table->string('type', 100);

            $table->string('title');

            $table->text('message');

            $table->string('icon', 100)
                ->nullable();

            $table->string('color', 50)
                ->nullable();

            $table->text('url')
                ->nullable();

            $table->timestamp('read_at')
                ->nullable();

            $table->json('data')
                ->nullable();

            $table->timestamps();

            $table->index([
                'education_user_id',
                'read_at',
            ]);

            $table->index([
                'education_user_id',
                'created_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'education_user_notifications'
        );
    }
};
