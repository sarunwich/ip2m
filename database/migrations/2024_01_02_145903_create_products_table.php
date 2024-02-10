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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',255);
            // $table->string('product_image',255)->nullable();
            $table->string('price',255)->nullable();
            $table->string('highlight',500)->nullable();
            $table->text('product_detail')->nullable();
            $table->string('display',100)->nullable();
            $table->text('keyword')->nullable();
           
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->unsignedBigInteger('IPdata_id')->nullable();
            $table->foreign('IPdata_id')->references('id')->on('i_pdatas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
