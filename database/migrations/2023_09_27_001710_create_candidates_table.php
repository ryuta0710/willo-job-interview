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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('job_id');
            $table->string('job_url');
            $table->string('shared_url')->nullable();
            $table->string('status')->default('init');
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->integer('review')->default(0);
            $table->dateTime('start_at')->nullable();
            $table->string('response_at')->nullable();
            $table->string('is_email_send')->nullable();
            $table->string('note')->default("");
            $table->string('url');
            $table->string('retake')->nullable();
            $table->string('name')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('user_id');
            $table->integer('company_id');
            $table->time('time')->nullable();
            $table->string('share_link')->nullable();
            $table->integer('share_allow')->nullable();
            $table->integer('share_visit')->default(0);
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
        Schema::dropIfExists('candidates');
    }
};
