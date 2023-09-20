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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('header_color')->nullable();
            $table->string('button_color')->nullable();
            $table->string('field')->nullable();
            $table->string('logo')->nullable();
            $table->integer('owner')->nullable();
            $table->integer('default')->nullable();
            // $table->foreign('owner')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
