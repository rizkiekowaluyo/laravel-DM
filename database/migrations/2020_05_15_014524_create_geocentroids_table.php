<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeocentroidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geocentroids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('distancecentroid1');
            $table->float('distancecentroid2');
            $table->float('distancecentroid3');
            $table->string('mindistance');           
            $table->integer('cluster');
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
        Schema::dropIfExists('geocentroids');
    }
}
