<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistanciaColumnToTrajectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trajectories', function (Blueprint $table) {
            $table->float('distancia')->after('puntoLlegada');
            
            if (Schema::hasColumn('fechaPartida', 'fechaLlegada'))
            {
                $table->dropColumn(['fechaPartida', 'fechaLlegada']);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trajectories', function (Blueprint $table) {
            //
        });
    }
}
