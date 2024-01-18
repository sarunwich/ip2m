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
        Schema::create('sellers', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('sid');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->foreign('profile_id')->references('profile_id')->on('profiles');
            $table->unsignedBigInteger('IPdata_id')->nullable();
            $table->foreign('IPdata_id')->references('IPdata_id')->on('i_pdatas');
            $table->string('store_name',255);
            $table->string('id_number',50);
            $table->tinyInteger('person_type')->nullable();
            
            $table->tinyInteger('accept')->nullable()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
