<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mobility;
use App\Models\Trajectorie;
use Illuminate\Http\Request;

class MobilityController extends Controller
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
        //
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
        $request->validate([
            'idTrajectorie' => 'required',
            'idTypeTransportation' => 'required',
            'costo' => 'required',
        ]);

        $trajectorie = Trajectorie::find($request->idTrajectorie);
        Mobility::create($request->all());
        return redirect()
                ->route('trajectorie.mobility', $trajectorie)
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobility  $mobility
     * @return \Illuminate\Http\Response
     */
    public function show(Mobility $mobility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobility  $mobility
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobility $mobility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobility  $mobility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mobility $mobility)
    {
        //dd($request->all());
        $request->validate([
            'idTrajectorie' => 'required',
            'idTypeTransportation' => 'required',
            'costo' => 'required',
        ]);

        $trajectorie = Trajectorie::find($request->idTrajectorie);
        
        $mobility->update($request->all());
        return redirect()
                ->route('trajectorie.mobility', $trajectorie)
                ->with([
                    'message' => 'El registro se editó satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobility  $mobility
     * @return \Illuminate\Http\Response
     */
    public function destroy($mobility)
    {
        Mobility::find($mobility)->delete();
    }
}
