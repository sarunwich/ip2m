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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sid')->nullable();
            $table->foreign('sid')->references('sid')->on('sellers');
            $table->unsignedBigInteger('rid')->nullable();
            $table->foreign('rid')->references('id')->on('users');
            $table->date('appointment_time')->nullable();
            $table->string('purpose',100)->nullable();
           
            $table->text('appointment_detail')->nullable();
            $table->string('other',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
