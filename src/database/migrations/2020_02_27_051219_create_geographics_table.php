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
            $table->float('kemiringanlereng',8,3);
            $table->float('jenistanah',8,3);
            $table->float('curahhujan',8,3);
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
