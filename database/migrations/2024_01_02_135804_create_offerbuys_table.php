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
        Schema::create('offerbuys', function (Blueprint $table) {
             $table->id();
            // $table->bigIncrements('offerbuy_id');
            // $table->unsignedBigInteger('rid')->nullable();
            // $table->foreign('rid')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->foreign('profile_id')->references('profile_id')->on('profiles');
            $table->text('Interest_data')->nullable();
            $table->text('offbuy_detail')->nullable();
            $table->date('offbuy_date')->nullable();
            $table->date('offerbuy_startdate')->nullable();
            $table->date('offerbuy_enddate')->nullable();
            $table->decimal('offerbuy_price',15,2)->nullable();
            $table->string('offerbuy_image',200)->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offerbuys');
    }
};
