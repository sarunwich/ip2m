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
        Schema::create('i_pdata_details', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('ipgroup_id');
            $table->unsignedBigInteger('IPdata_id')->nullable();
            $table->foreign('IPdata_id')->references('IPdata_id')->on('i_pdatas');
            $table->unsignedBigInteger('ipdetail_id')->nullable();
            $table->foreign('ipdetail_id')->references('ipdetail_id')->on('i_pdetails');
            $table->string('IPdataDetail_data',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_pdata_details');
    }
};
