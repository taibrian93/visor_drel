<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->char('codigoCentroPobladoMINEDU', 6)->nullable();
            //$table->foreign('codigoCentroPobladoMINEDU')->references('codigoCentroPobladoMINEDU')->on('population_centers')->onDelete('cascade')->onUpdate('cascade');
            $table->char('codigoUbigeoDistrito', 6)->nullable();
            $table->char('codigoLocal', 10)->nullable();
            $table->char('codigoModular', 10)->nullable();
            $table->text('nombreCentroEducativo')->nullable();
            $table->text('direccionCentroEducativo')->nullable();
            $table->longText('y')->nullable();
            $table->longText('x')->nullable();
            $table->string('fuenteCoordenadaLocalEscolar')->nullable();
            $table->string('codigoNivelModalidad')->nullable();
            $table->string('codigoNivelDependencia')->nullable();
            $table->text('centroPoblado')->nullable();
            $table->string('fuenteGeografica')->nullable();
            $table->string('fuenteCoordenadaCentroPobladoEscolar')->nullable();
            $table->char('codigoDREUGEL',10)->nullable();
            $table->text('supervisaDREUGEL')->nullable();
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
        Schema::dropIfExists('colleges');
    }
}
