<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use App\Models\Route;
use App\Models\Trajectorie;
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
            'colleges.id',
            'colleges.nombreCentroEducativo as message1',
            'colleges.direccionCentroEducativo as message2',
            'colleges.codigoLocal as message3',
            'colleges.codigoModular as message4',
            'colleges.codigoUbigeoDistrito as message5',
            'colleges.x',
            'colleges.y',
            'colleges.codigoCentroPobladoMINEDU',
            'population_centers.x as x_populationCenter',
            'population_centers.y as y_populationCenter',
            'population_centers.descripcion as centroPoblado',
        ];
        
        $colleges = College::select($parameters)
                    ->leftJoin('population_centers', 'colleges.codigoCentroPobladoMINEDU', '=', 'population_centers.codigoCentroPobladoMINEDU')
                    ->where('colleges.codigoUbigeoDistrito', 'LIKE', $request->idProvince.'%');
        
        if($request->filter == 1){
            $colleges = $colleges->where('colleges.nombreCentroEducativo', 'LIKE', '%'.$request->val.'%')->get();
        }
        if($request->filter == 2){
            $colleges = $colleges->where('colleges.codigoModular', 'LIKE', '%'.$request->val.'%')->first();

            if($colleges == null){
                $colleges = [];
            } else{

                $routes = Route::select('routes.id')
                                ->leftJoin('colleges', 'routes.idCollege', '=', 'colleges.id')
                                ->where('colleges.codigoModular', '=', $request->val)
                                ->get();

                $colleges = $colleges->toArray();
                $colleges['routes'] = [];
                
                foreach ($routes as $key1 =>  $route) {
                    $trajectories = Trajectorie::where('idRoute', '=', $route->id)->get()->toArray();
                    // dd($trajectories);
                    foreach ($trajectories as $key2 => $trajectorie){
                        $trajectoriePuntoPartida = PopulationCenter::select('x as x_puntoPartida', 'y as y_puntoPartida', 'descripcion as centro_poblado_PP')->where('id', '=', $trajectorie["puntoPartida"])->first()->toArray();
                        //$trajectoriePuntoLlegada = PopulationCenter::select('x as x_puntoLlegada', 'y as y_puntoLlegada')->where('id', '=', $trajectorie["puntoLlegada"])->first()->toArray();
                        //array_push($trajectories[$key2], $trajectoriePuntoPartida['x_puntoPartida'], $trajectoriePuntoPartida['y_puntoPartida'], $trajectoriePuntoLlegada['x_puntoLlegada'], $trajectoriePuntoLlegada['y_puntoLlegada']);
                        $trajectories[$key2] += [ "x_puntoPartida" => $trajectoriePuntoPartida['x_puntoPartida'] ];
                        $trajectories[$key2] += [ "y_puntoPartida" => $trajectoriePuntoPartida['y_puntoPartida'] ];
                        $trajectories[$key2] += [ "centro_poblado_PP" => $trajectoriePuntoPartida['centro_poblado_PP'] ];
                        // $trajectories[$key2] += [ "x_puntoLlegada" => $trajectoriePuntoLlegada['x_puntoLlegada'] ];
                        // $trajectories[$key2] += [ "y_puntoLlegada" => $trajectoriePuntoLlegada['y_puntoLlegada'] ];
                        // $trajectories = array_merge($arrayTrajectories[$key2],$trajectoriePuntoPartida, $trajectoriePuntoLlegada);
                        //array_push($trajectories[$key2], $trajectoriePuntoPartida, $trajectoriePuntoLlegada);
                    }
                    $colleges['routes'][$key1] = $trajectories;
                } 
            }
            //dd($colleges);

        }
        if($request->filter == 3){
            $colleges = $colleges->where('colleges.codigoLocal', 'LIKE', '%'.$request->val.'%')->get();
        }

        // foreach($colleges->get() as $college){
        //     $populationCenter = PopulationCenter::where()->first;
        //     // echo response()->json($colleges->get());
        // }

        // $array = [];
                            
        return response()->json($colleges);
    }
}
