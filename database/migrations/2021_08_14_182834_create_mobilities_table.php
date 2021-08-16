<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTrajectorie');
            $table->foreign('idTrajectorie')->references('id')->on('trajectories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idTypeTransportation')->nullable();
            $table->foreign('idTypeTransportation')->references('id')->on('type_transportations')->onDelete('set null')->onUpdate('cascade');
            $table->decimal('costo');
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
        Schema::dropIfExists('mobilities');
    }
}
