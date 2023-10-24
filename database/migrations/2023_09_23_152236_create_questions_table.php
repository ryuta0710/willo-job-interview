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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->default("video");
            $table->integer('retake')->nullable();
            $table->string('content');
            $table->integer('answer_time')->nullable();
            $table->string('limit_type')->default("word");
            $table->integer('max')->default(500);
            $table->integer('thinking_hour')->nullable();
            $table->integer('thinking_minute')->nullable();
            $table->integer('question_no');
            $table->integer('job_id');
            $table->integer('user_id');
            $table
                ->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
