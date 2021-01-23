<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('total_rooms');
            $table->unsignedBigInteger('category_id');
            $table->mediumText('description');
            $table->integer('views')->nullable();
            $table->unsignedBigInteger('images')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('rooms');
    }
}
