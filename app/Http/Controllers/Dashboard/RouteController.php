<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\District;
use App\Models\PopulationCenter;
use App\Models\Province;
use App\Models\Route;
use App\Models\Trajectorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Crear')->only('create','store');
        $this->middleware('can:Leer')->only('index', 'show');
        $this->middleware('can:Editar')->only('edit', 'update');
        $this->middleware('can:Eliminar')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = Route::class;
        return view('dashboard.route.index')
                ->with(['route' => $route]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colleges = College::select('id', 'nombreCentroEducativo')->orderBy('id','asc')->take(1)->pluck('nombreCentroEducativo','id');
        return view('dashboard.route.create')
                ->with(['colleges' => $colleges]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idCollege' => 'required',
            'descripcion' => 'required|max:200',
        ]);
        $request->merge(['descripcion' => strtoupper($request->descripcion)]);
        Route::create($request->all());
        return redirect()
                ->route('route.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        
        $colleges = College::select('id', 'nombreCentroEducativo')
                            ->where('id', $route->idCollege)
                            ->orderBy('id','asc')
                            ->pluck('nombreCentroEducativo','id');
        return view('dashboard.route.edit')
                ->with([
                    'route' => $route,
                    'colleges' => $colleges
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'idCollege' => 'required',
            'descripcion' => 'required|max:200',
        ]);
        $request->merge(['descripcion' => strtoupper($request->descripcion)]);
        $route->update($request->all());
        return redirect()
                ->route('route.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy($route)
    {
        Route::find($route)->delete();
    }

    public function getColleges(Request $request){
        if(strlen($request->data) > 1){
            $colleges = College::select('provinces.descripcion as province', 'districts.descripcion as district', 'population_centers.descripcion as population_center','colleges.id', 'colleges.nombreCentroEducativo')
                        ->leftJoin('population_centers', 'colleges.codigoCentroPobladoMINEDU', '=', 'population_centers.codigoCentroPobladoMINEDU')
                        ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                        ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id');
            if($request->filter == 1){
                $colleges = $colleges->where('nombreCentroEducativo', 'LIKE', '%'.$request->data.'%')->orderBy('nombreCentroEducativo','asc');
            }
            if($request->filter == 2){
                $colleges = $colleges->where('codigoModular', 'LIKE', '%'.$request->data.'%')->orderBy('codigoModular','asc');
            }
            if($request->filter == 3){
                $colleges = $colleges->where('codigoLocal', 'LIKE', '%'.$request->data.'%')->orderBy('codigoLocal','asc');
            }

            return response()->json($colleges->get());
        }
        
    }

    public function trajectorie(Route $route){
        $trajectories = Trajectorie::where('idRoute', $route->id)
                        ->get();

        $provinces = Province::select('codigoUbigeo',DB::raw('CONCAT(descripcion, " - ", codigoUbigeo) AS descripcion'))->orderBy('codigoUbigeo','asc')->pluck('descripcion','codigoUbigeo');
        $districts = District::select('districts.codigoUbigeo',DB::raw('CONCAT(districts.descripcion, " - ", districts.codigoUbigeo) AS descripcion'))
                    ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id')
                    ->where('provinces.codigoUbigeo', '=', '1601')
                    ->orderBy('codigoUbigeo','asc')
                    ->pluck('descripcion','codigoUbigeo');
        $populationCenters = PopulationCenter::select('population_centers.codigoCentroPobladoMINEDU',DB::raw('CONCAT(population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                            ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                            ->where('districts.codigoUbigeo', '=', '160101')
                            ->orderBy('codigoUbigeoDistrito','asc')
                            ->pluck('descripcion','codigoCentroPobladoMINEDU');                
        
        $puntoLlegada = PopulationCenter::select('population_centers.*',DB::raw('CONCAT(provinces.descripcion, " - ", districts.descripcion, " - " ,population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                        ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                        ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id');
        
        $idPopulationCenter = Helper::getPopulationCenterId($route->idCollege);

        
       
        $destinoFinal = PopulationCenter::select('id',DB::raw('CONCAT(provincia, " - " ,descripcion, " - ", codigoCentroPobladoMINEDU) AS descripcion'))->where('id', $idPopulationCenter);
        $checkDestinoFinal = Trajectorie::where('idRoute', $route->id)->where('puntoLLegada', $idPopulationCenter)->get();
        $check = sizeof($checkDestinoFinal) > 0 ? true : false;
        if($trajectories->count() > 0){
            $getLastTrajectorie = Trajectorie::where('idRoute', $route->id)->orderBy('id','desc')->take(1)->first();
            $getRows = Trajectorie::where('idRoute', $route->id)
                        ->pluck('puntoLlegada')
                        ->toArray();
            
            $puntoPartida = PopulationCenter::select('population_centers.*',DB::raw('CONCAT(provinces.descripcion, " - ", districts.descripcion, " - " ,population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                            ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                            ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id')
                            ->where('population_centers.id', '=', $getLastTrajectorie->puntoLlegada)
                            ->orderBy('population_centers.codigoUbigeoDistrito','desc')
                            ->take(1);
                            
            array_push($getRows, $idPopulationCenter);

            //dd($getRows);

            $puntoLlegada = $puntoLlegada->where('districts.codigoUbigeo', '=', '160101')
                        ->whereNotIn('population_centers.id', $getRows)
                        ->whereNotIn('population_centers.codigoCentroPobladoMINEDU', ['114683'])
                        ->orderBy('population_centers.codigoUbigeoDistrito','asc');

        } else {
            $puntoPartida = PopulationCenter::select('population_centers.*',DB::raw('CONCAT(provinces.descripcion, " - ", districts.descripcion, " - " ,population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                            ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                            ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id')
                            ->where('population_centers.cpinei', '=', '1601010001')
                            ->orderBy('population_centers.codigoUbigeoDistrito','asc');

            $puntoLlegada = $puntoLlegada->where('districts.codigoUbigeo', '=', '160101')
                            ->whereNotIn('population_centers.codigoCentroPobladoMINEDU', ['114683'])
                            ->orderBy('population_centers.codigoUbigeoDistrito','asc');
        }

        return view('dashboard.trajectorie.create')
                ->with([
                    'route' => $route,
                    'trajectories' => $trajectories,
                    'province' => $provinces,
                    'district' => $districts,
                    'puntoPartida' => $puntoPartida->pluck('descripcion','id'),
                    'puntoLlegada' => $puntoLlegada->pluck('descripcion','id'),
                    'destinoFinal' => $destinoFinal->pluck('descripcion','id'),
                    'check' => $check,
                ]);
    }

    public function getRouteCollege($idCollege){


        $college = College::find($idCollege);
        if($college == null){
            return abort(404);
        }
        $collegeRoutes = Route::where('idCollege', $idCollege)->with('trajectorie')->get();
        
        return view('dashboard.route.show')
                ->with([
                    'college' => $college,
                    'collegeRoutes' => $collegeRoutes,
                ]);
        
    }
}
