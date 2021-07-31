<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use Illuminate\Http\Request;

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
        $populationCenters = PopulationCenter::select('codigoCentroPobladoMINEDU','descripcion')->orderBy('codigoUbigeoDistrito','asc')->pluck('descripcion','codigoCentroPobladoMINEDU');
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
        //
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
        $populationCenters = PopulationCenter::select('codigoCentroPobladoMINEDU','descripcion')->orderBy('codigoUbigeoDistrito','asc')->pluck('descripcion','codigoCentroPobladoMINEDU');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(College $college)
    {
        //
    }
}
