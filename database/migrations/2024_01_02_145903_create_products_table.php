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
            $table->string('product_image',255)->nullable();
            $table->decimal('price',15,2)->nullable();
            $table->string('highlight',500)->nullable();
            $table->text('product_detail')->nullable();
            $table->string('display',100)->nullable();
            $table->string('keyword',100)->nullable();
           
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->unsignedBigInteger('iptype_id')->nullable();
            $table->foreign('iptype_id')->references('iptype_id')->on('i_ptypes');
            $table->unsignedBigInteger('IPdata_id')->nullable();
            $table->foreign('IPdata_id')->references('IPdata_id')->on('i_pdatas');
            
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
