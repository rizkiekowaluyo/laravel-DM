<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelperdisastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helperdisasters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('bnJumlahKejadian');
            $table->float('bnJumlahKorban');
            $table->float('bnJumlahKerusakan');
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
        Schema::dropIfExists('helperdisasters');
    }
}
