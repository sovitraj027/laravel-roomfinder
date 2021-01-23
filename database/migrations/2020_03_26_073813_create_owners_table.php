<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('place_id');
            $table->string('link')->nullable();
            $table->mediumText('description');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('owners');
    }
}
