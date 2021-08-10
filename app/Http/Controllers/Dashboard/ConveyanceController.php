<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Conveyance;
use Illuminate\Http\Request;

class ConveyanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conveyance = Conveyance::class;
        return view('dashboard.conveyance.index')
                ->with(['conveyance' => $conveyance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.conveyance.create');
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
            'descripcion' => 'required|max:200',
        ]);

        Conveyance::create($request->all());
        return redirect()
                ->route('conveyance.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conveyance  $conveyance
     * @return \Illuminate\Http\Response
     */
    public function show(Conveyance $conveyance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conveyance  $conveyance
     * @return \Illuminate\Http\Response
     */
    public function edit(Conveyance $conveyance)
    {
        return view('dashboard.conveyance.edit')->with([
            'conveyance' => $conveyance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conveyance  $conveyance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conveyance $conveyance)
    {
        $request->validate([
            'descripcion' => 'required|max:200',
        ]);

        $conveyance->update($request->all());
        return redirect()
                ->route('conveyance.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conveyance  $conveyance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conveyance $conveyance)
    {
        //
    }
}
