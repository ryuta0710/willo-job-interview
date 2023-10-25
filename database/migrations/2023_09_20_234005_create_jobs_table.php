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
            $table->integer('salary');
            $table->string('company_id');
            $table->string('video_url')->nullable();
            $table->string('video_rc_url')->nullable();
            $table->text('description')->nullable();
            $table->string('record')->default("false");
            $table->integer('user_id');
            $table->integer('mail_invite_id')->nullable();
            $table->integer('mail_success_id')->nullable();
            $table->integer('mail_reminder_id')->nullable();
            $table->integer('sms_invite_id')->nullable();
            $table->integer('sms_reminder_id')->nullable();
            $table->string('limit_date')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('language')->nullable();
            $table->string('isTip')->nullable();
            $table->string('isFollow')->nullable();
            $table->string('url')->nullable();
            $table->integer('responses_count')->default(0);
            $table->string('status')->default('draft');
            $table->integer('field_id');
            $table->integer('started_count')->default(0);
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
