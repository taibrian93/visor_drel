<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(PopulationCenter $populationCenter)
    {
        //
    }
}
