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
        Schema::create('i_pgroups', function (Blueprint $table) {
            $table->bigIncrements('ipgroup_id');
            $table->unsignedBigInteger('iptype_id')->nullable();
            $table->foreign('iptype_id')->references('iptype_id')->on('i_ptypes');
            $table->unsignedBigInteger('ipdetail_id')->nullable();
            $table->foreign('ipdetail_id')->references('ipdetail_id')->on('i_pdetails');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_pgroups');
    }
};
