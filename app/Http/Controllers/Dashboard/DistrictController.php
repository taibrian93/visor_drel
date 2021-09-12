<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
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
        $district = District::class;
        return view('dashboard.district.index')
                ->with(['district' => $district]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::select('id', 'descripcion')->orderBy('codigoUbigeo','asc')->pluck('descripcion','id');
        return view('dashboard.district.create')
                ->with(['provinces' => $provinces]);
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
            'idProvince' => 'required',
            'descripcion' => 'required|max:200',
            'codigoUbigeo' => 'required|numeric|regex:/^[0-9]{6}$/',
        ]);

        District::create($request->all());
        return redirect()
                ->route('district.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $provinces = Province::select('id', 'descripcion')->orderBy('codigoUbigeo','asc')->pluck('descripcion','id');
        return view('dashboard.district.edit')
                ->with([
                    'provinces' => $provinces,
                    'district' => $district,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'idProvince' => 'required',
            'descripcion' => 'required|max:200',
            'codigoUbigeo' => 'required|numeric|regex:/^[0-9]{6}$/',
        ]);

        $district->update($request->all());
        return redirect()
                ->route('district.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($district)
    {
        District::find($district)->delete();
    }

    public function getDistrict(Request $request){
        $district = District::where('codigoUbigeo', 'LIKE', $request->codigoUbigeo.'%');
        return response()->json($district->get());
    }
}
