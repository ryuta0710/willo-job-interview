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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('salary');
            $table->string('company_id');
            $table->string('video_url')->nullable();
            $table->string('video_rc_url')->nullable();
            $table->string('description')->nullable();
            $table->string('record')->default("false");
            $table->integer('user_id');
            $table->integer('mail_invite_id')->nullable();
            $table->integer('mail_success_id')->nullable();
            $table->integer('mail_reminder_id')->nullable();
            $table->integer('sms_invite_id')->nullable();
            $table->integer('sms_reminder_id')->nullable();
            $table->integer('limit_date')->nullable();
            $table->integer('redirect_url')->nullable();
            $table->integer('language')->nullable();
            $table->integer('isTip')->nullable();
            $table->integer('isFollow')->nullable();
            $table->integer('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
