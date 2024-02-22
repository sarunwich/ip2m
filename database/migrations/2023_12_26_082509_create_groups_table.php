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
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('group_id'); // Auto-incrementing primary key
            $table->string('group_name', 50)->nullable(false); // Define 'group_name' as not nullable and limit its length to 50 characters
            $table->string('image', 30)->nullable(false); // Define 'image' as not nullable and limit its length to 30 characters
            $table->integer('order')->nullable(false); // Define 'order' as not nullable
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
