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
        Schema::create('product_imagebuys', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('ProductImagebuy_id');
            $table->string('ProductImagebuy_name',255)->nullable();
            $table->unsignedBigInteger('offerbuy_id')->nullable();
            $table->foreign('offerbuy_id')->references('id')->on('offerbuys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_imagebuys');
    }
};
