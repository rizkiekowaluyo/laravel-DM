<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namawilayah');
            $table->float('kemiringanlereng');
            $table->float('jenistanah');
            $table->float('curahhujan');
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
        Schema::dropIfExists('geographics');
    }
}
