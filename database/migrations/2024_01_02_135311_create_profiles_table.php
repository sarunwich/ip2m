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
        Schema::create('profiles', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('profile_id');
            $table->string('profile_name',255);
            $table->string('profile_picture',100);
            $table->string('institute',255);
            $table->string('country',100);
            $table->string('address',100);
            $table->string('province',100);
            $table->string('district',100);
            $table->string('tombon',100);
            $table->string('zipcode',5);
            $table->string('tel',10);
            $table->string('website',100);
            $table->string('facebook',100);
            $table->string('twitter',100);
            $table->string('line',100);
            $table->string('Instagram',100);
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
        Schema::dropIfExists('profiles');
    }
};
