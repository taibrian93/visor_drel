<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_centers', function (Blueprint $table) {
            $table->id();
            $table->char('codigoUbigeoDistrito', 6);
            $table->foreign('codigoUbigeoDistrito')->references('codigoUbigeo')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->char('codigoCentroPobladoMINEDU', 6)->unique();
            $table->string('descripcion');
            $table->integer('capital')->nullable();
            $table->integer('con_ie')->nullable();
            $table->string('nivel')->nullable();
            $table->char('cpinei',10)->nullable();
            $table->string('fuente_ine')->nullable();
            $table->string('fuente_g')->nullable();
            $table->longText('x')->nullable();
            $table->longText('y')->nullable();
            $table->string('departmento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
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
        Schema::dropIfExists('population_centers');
    }
}
