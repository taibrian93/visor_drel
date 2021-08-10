<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_transportations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idConveyance');
            $table->foreign('idConveyance')->references('id')->on('conveyances')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descripcion');
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
        Schema::dropIfExists('type_transportations');
    }
}
