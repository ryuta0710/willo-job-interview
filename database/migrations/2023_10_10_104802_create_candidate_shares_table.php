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
        Schema::create('candidate_shares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('candidate_id');
            $table->integer('q_no');
            $table->integer('allow')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_shares');
    }
};
