<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PopulationCenter;
use Illuminate\Http\Request;

class PopulationCenterController extends Controller
{
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
}
