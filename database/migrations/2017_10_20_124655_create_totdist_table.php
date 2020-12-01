<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotdistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tot_dist', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('assetid');
            $table->integer('typeid');
            $table->string('vehicle');
            $table->string('starttime');
            $table->string('stoptime');
            $table->string('beginingmileage');
            $table->string('endmileage');
            $table->integer('totaldistance');
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
        Schema::dropIfExists('tot_dist');
    }
}
