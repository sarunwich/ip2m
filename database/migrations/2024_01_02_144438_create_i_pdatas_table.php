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
        Schema::create('i_pdatas', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('IPdata_id');
            $table->unsignedBigInteger('iptype_id')->nullable();
            $table->foreign('iptype_id')->references('iptype_id')->on('i_ptypes');
            $table->unsignedBigInteger('rid')->nullable();
            $table->foreign('rid')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_pdatas');
    }
};
