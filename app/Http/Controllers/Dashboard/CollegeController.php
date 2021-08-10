<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $college = College::class;
        return view('dashboard.college.index')
                ->with(['college' => $college]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $populationCenters = PopulationCenter::select('codigoCentroPobladoMINEDU',DB::raw('CONCAT(descripcion, " - ", codigoCentroPobladoMINEDU) AS descripcion'))->orderBy('codigoUbigeoDistrito','asc')->pluck('descripcion','codigoCentroPobladoMINEDU');
        return view('dashboard.college.create')->with(['populationCenters' => $populationCenters]);
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
            'codigoCentroPobladoMINEDU' => 'required|numeric',
            'codigoLocal' => 'required|regex:/^[0-9]*$/',
            'codigoModular' => 'required|regex:/^[0-9]*$/',
            'nombreCentroEducativo' => 'required|min:2|',
            //'nombreDirector' => 'required|min:2',
            'direccionCentroEducativo' => 'required|min:2',
            'x' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'y' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        ]);

        College::create($request->all());
        return redirect()
                ->route('college.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        $populationCenters = PopulationCenter::select('codigoCentroPobladoMINEDU', DB::raw('CONCAT(descripcion, " - ", codigoCentroPobladoMINEDU) AS descripcion'))->orderBy('codigoUbigeoDistrito','asc')->pluck('descripcion','codigoCentroPobladoMINEDU');
        return view('dashboard.college.edit')->with([
            'college' => $college,
            'populationCenters' => $populationCenters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, College $college)
    {
        $request->validate([
            'codigoCentroPobladoMINEDU' => 'required|numeric',
            'codigoLocal' => 'required|regex:/^[0-9]*$/',
            'codigoModular' => 'required|regex:/^[0-9]*$/',
            'nombreCentroEducativo' => 'required|min:2|',
            //'nombreDirector' => 'required|min:2',
            'direccionCentroEducativo' => 'required|min:2',
            'x' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'y' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        ]);

        $college->update($request->all());
        return redirect()
                ->route('college.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy($college)
    {
        College::find($college)->delete();
    }
}
