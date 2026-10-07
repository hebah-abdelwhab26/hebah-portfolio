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
        Schema::create('education_comments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | COMMENT AUTHOR
            |--------------------------------------------------------------------------
            */

            $table->string('name', 100);

            $table->string('email')->nullable();

            /*
            |--------------------------------------------------------------------------
            | COMMENT CONTENT
            |--------------------------------------------------------------------------
            */

            $table->text('comment');

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            |
            | pending  = بانتظار المراجعة
            | approved = ظاهر للزوار
            | rejected = مرفوض
            |
            */

            $table->string('status', 20)->default('pending')->index();

            /*
            |--------------------------------------------------------------------------
            | SECURITY / META
            |--------------------------------------------------------------------------
            */

            $table->ipAddress('ip_address')->nullable();

            $table->text('user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_comments');
    }
};
