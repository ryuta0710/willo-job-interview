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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('job_id');
            $table->integer('candidate_id');
            $table->mediumText('content')->nullable();
            $table->string('rc_url')->nullable();
            $table->string('question_type');
            $table->integer('question_id');
            $table->string('url');
            $table->string('question_content');
            $table->string('count')->nullable();
            $table->integer('thinking_minute')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
