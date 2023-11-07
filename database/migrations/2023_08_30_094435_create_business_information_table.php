<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('bname');
            $table->string('bemail');
            $table->string('bphone');
            $table->string('website_url')->nullable();
            $table->string('baddress')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('description')->nullable();
            $table->string('radius_address');
            $table->string('radius');
            $table->string('radius_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_information');
    }
};
