<?php
namespace App\Helpers;

use App\Models\College;
use App\Models\PopulationCenter;

class Helper
{   

    public static function getDescriptionPopulationCenter($id)
    {
        $populationCenter = PopulationCenter::find($id);
        $provincia = $populationCenter->provincia;
        $centroPolado = $populationCenter->descripcion;

        return $provincia.' - '.$centroPolado;
    }

    public static function getPopulationCenterId($id){
        $college = College::find($id);
        $populationCenter = PopulationCenter::where('codigoCentroPobladoMINEDU', $college->codigoCentroPobladoMINEDU)->first();

        return $populationCenter->id;
    }

    public static function getDistance($lat1, $lat2, $lon1, $lon2){
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        
        return ($miles * 1.609344);
    }
}