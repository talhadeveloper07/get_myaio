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
        Schema::table('business_information', function (Blueprint $table) {
            $table->foreignId('closure_id')->nullable();
            $table->foreign('closure_id')->references('closure_id')->on('closures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_information', function (Blueprint $table) {
            //
        });
    }
};
