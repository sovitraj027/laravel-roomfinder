
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{

    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('city_id');
            $table->double('latitude',10,7);
            $table->double('longitude',10,7);
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('places');
    }
}
