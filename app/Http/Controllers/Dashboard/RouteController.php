<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
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
        $colleges = College::select('id', 'nombreCentroEducativo')->orderBy('id','asc')->pluck('nombreCentroEducativo','id');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        $colleges = College::select('id', 'nombreCentroEducativo')->orderBy('id','asc')->pluck('nombreCentroEducativo','id');
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
    public function destroy(Route $route)
    {
        //
    }
}
