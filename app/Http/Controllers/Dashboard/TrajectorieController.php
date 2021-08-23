<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Conveyance;
use App\Models\Mobility;
use App\Models\PopulationCenter;
use App\Models\Route;
use App\Models\Trajectorie;
use App\Models\TypeTransportation;
use Illuminate\Http\Request;

class TrajectorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Trajectorie::create($request->all());
        return redirect()
                ->route('route.getColleges')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puntoPartida = PopulationCenter::find($request->puntoPartida);
        $puntoLlegada = PopulationCenter::find($request->puntoLlegada);

        $distancia = Helper::getDistance($puntoPartida->x, $puntoLlegada->x, $puntoPartida->y, $puntoLlegada->y);
        $request->merge(['distancia' => $distancia]);
        Trajectorie::create($request->all());
        $route = Route::find($request->idRoute);
        return redirect()
                ->route('route.trajectorie',$route)
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trajectorie  $trajectorie
     * @return \Illuminate\Http\Response
     */
    public function show(Trajectorie $trajectorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trajectorie  $trajectorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Trajectorie $trajectorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trajectorie  $trajectorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trajectorie $trajectorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trajectorie  $trajectorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($trajectorie)
    {
        Trajectorie::find($trajectorie)->delete();
    }

    public function mobility(Trajectorie $trajectorie){
        $conveyances = Conveyance::pluck('descripcion', 'id');
        $mobilities = Mobility::where('idTrajectorie', $trajectorie->id)->get();

        //dd($conveyances);
        return view('dashboard.mobility.create')
                ->with([
                    'conveyances' => $conveyances,
                    'trajectorie' => $trajectorie,
                    'mobilities' => $mobilities,
                ]);
    }

    public function editMobility(Trajectorie $trajectorie, $idMobility){
        $mobility = Mobility::select('mobilities.*', 'conveyances.id AS conveyances')
                            ->leftJoin('type_transportations', 'type_transportations.id', '=', 'mobilities.idTypetransportation')
                            ->leftJoin('conveyances', 'conveyances.id', '=', 'type_transportations.idConveyance')
                            ->find($idMobility);
        
        $getArray = Mobility::where('idTrajectorie', $trajectorie->id)->pluck('idTypeTransportation')->toArray();
        
        $conveyances = Conveyance::pluck('descripcion', 'id');
        $idTypeTransportation = TypeTransportation::where('idConveyance', $mobility->conveyances)->whereNotIn('id', $getArray)->pluck('descripcion', 'id');
        $mobilities = Mobility::where('idTrajectorie', $trajectorie->id)->get();

        //dd($conveyances);
        return view('dashboard.mobility.edit')
                ->with([
                    'conveyances' => $conveyances,
                    'trajectorie' => $trajectorie,
                    'mobilities' => $mobilities,
                    'mobility' => $mobility,
                    'idTypeTransportation' => $idTypeTransportation,
                ]);
    }
}
