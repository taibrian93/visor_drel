<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use Illuminate\Http\Request;

class VisorController extends Controller
{

    public function getColleges(Request $request){
        $model = College::class;
        $arrayData = $request->data;
        $arrayResult = [];
        $parameters = [
            'nombreCentroEducativo as message1',
            'direccionCentroEducativo as message2',
            'codigoLocal as message3',
            'codigoModular as message4',
            'codigoUbigeoDistrito as message5',
            'x',
            'y',
        ];

        foreach($arrayData as $key => $value){
            $arrayResult = $this->getData($model, $value, $arrayResult, $parameters);
            
        }
        
        return response()->json($arrayResult);
    }

    public function populationCenters(Request $request){
        $model = PopulationCenter::class;
        $arrayData = $request->data;
        $arrayResult = [];
        $parameters = [
            'descripcion as message1',
            //'codigoCentroPobladoMINEDU',
            'departmento as message2',
            'provincia as message3',
            'distrito as message4',
            'codigoUbigeoDistrito as message5',
            'x',
            'y',
        ];

        foreach($arrayData as $key => $value){
            $arrayResult = $this->getData($model, $value, $arrayResult, $parameters);
            
        }
        
        return response()->json($arrayResult);
    }

    public function getData($model, $data, $arrayResults, $parameters){
        
        if($data == 1){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1601%')->get();
            array_push($arrayResults,$colleges);
            
        }
        if($data == 2){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1602%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 3){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1603%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 4){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1604%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 5){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1605%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 6){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1606%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 7){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1607%')->get();
            array_push($arrayResults,$colleges);
        }
        if($data == 8){
            $colleges = $model::select($parameters)->where('codigoUbigeoDistrito', 'like', '1608%')->get();
            array_push($arrayResults,$colleges);
        }

        return $arrayResults;
    }

    public function getCollege(Request $request){
        $parameters = [
            'nombreCentroEducativo as message1',
            'direccionCentroEducativo as message2',
            'codigoLocal as message3',
            'codigoModular as message4',
            'codigoUbigeoDistrito as message5',
            'x',
            'y',
        ];
        $college = College::select($parameters)->where('codigoUbigeoDistrito', 'LIKE', $request->idProvince.'%');
        //dd($request->all());
        if($request->filter == 1){
            $college = $college->where('nombreCentroEducativo', 'LIKE', '%'.$request->val.'%');
        }
        if($request->filter == 2){
            $college = $college->where('codigoModular', 'LIKE', '%'.$request->val.'%');
        }
        if($request->filter == 3){
            $college = $college->where('codigoLocal', 'LIKE', '%'.$request->val.'%');
        }
                            
        return response()->json($college->get());
    }
}
