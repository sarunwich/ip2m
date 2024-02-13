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
        Schema::create('response_offerbuys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('res_id')->nullable();
            $table->foreign('res_id')->references('id')->on('users');
            $table->unsignedBigInteger('offerbuy_id')->nullable();
            $table->foreign('offerbuy_id')->references('id')->on('offerbuys');
            $table->date('response_date')->nullable();
            $table->text('response_detail')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_offerbuys');
    }
};
