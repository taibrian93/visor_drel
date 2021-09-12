<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PopulationCenter;
use App\Models\Trajectorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulationCenterController extends Controller
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
        $populationCenter = PopulationCenter::class;
        return view('dashboard.population_center.index')
                ->with(['populationCenter' => $populationCenter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::select('descripcion', 'codigoUbigeo')->orderBy('codigoUbigeo','asc')->pluck('descripcion','codigoUbigeo');
        return view('dashboard.population_center.create')
                ->with(['districts' => $districts]);
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
            'codigoUbigeoDistrito' => 'required',
            'codigoCentroPobladoMINEDU' => 'required',
            'x' => 'required',
            'y' => 'required',
            'descripcion' => 'required',
        ]);

        PopulationCenter::create($request->all());
        return redirect()
                ->route('populationCenter.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function show(PopulationCenter $populationCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(PopulationCenter $populationCenter)
    {
        $districts = District::select('descripcion', 'codigoUbigeo')->orderBy('codigoUbigeo','asc')->pluck('descripcion','codigoUbigeo');
        return view('dashboard.population_center.edit')
                ->with([
                    'districts' => $districts,
                    'populationCenter' => $populationCenter,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PopulationCenter $populationCenter)
    {
        $request->validate([
            'codigoUbigeoDistrito' => 'required',
            'codigoCentroPobladoMINEDU' => 'required',
            'x' => 'required',
            'y' => 'required',
            'descripcion' => 'required',
        ]);

        $populationCenter->update($request->all());
        return redirect()
                ->route('populationCenter.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy($populationCenter)
    {
        PopulationCenter::find($populationCenter)->delete();
    }

    public function getPopulationCenter(Request $request){
        $populationCenter = PopulationCenter::where('codigoUbigeoDistrito', 'LIKE', $request->codigoUbigeo.'%');
        return response()->json($populationCenter->get());
    }

    public function getPopulationCenterDestination(Request $request){
        
        $idPopulationCenter = Helper::getPopulationCenterId($request->routeIdCollege);

        //$populationCenter = PopulationCenter::where('codigoUbigeoDistrito', 'LIKE', $request->codigoUbigeo.'%');

        $populationCenter = PopulationCenter::select('provinces.descripcion as province','districts.descripcion as district','population_centers.*',DB::raw('CONCAT(provinces.descripcion, " - ", districts.descripcion, " - " ,population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                        ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                        ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id');

        $getRows = Trajectorie::where('idRoute', $request->routeId)
                        ->pluck('puntoLlegada')
                        ->toArray();

        array_push($getRows, $idPopulationCenter);

        $populationCenter = $populationCenter->where('districts.codigoUbigeo', 'LIKE', $request->codigoUbigeo.'%')
                        ->whereNotIn('population_centers.id', $getRows)
                        ->whereNotIn('population_centers.codigoCentroPobladoMINEDU', ['114683'])
                        ->orderBy('population_centers.codigoUbigeoDistrito','asc');


        return response()->json($populationCenter->get());
    }
}
