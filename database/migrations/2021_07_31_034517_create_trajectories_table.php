<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrajectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajectories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRoute');
            $table->foreign('idRoute')->references('id')->on('routes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('puntoPartida');
            $table->bigInteger('puntoLlegada');
            $table->date('fechaPartida');
            $table->date('fechaLlegada');
            $table->timestamps();
            $table->boolean('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trajectories');
    }
}
