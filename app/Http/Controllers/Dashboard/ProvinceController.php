<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $province = Province::class;
        return view('dashboard.province.index')
                ->with(['province' => $province]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::select('id', 'descripcion')->orderBy('codigoUbigeo','asc')->pluck('descripcion','id');
        return view('dashboard.province.create')
                ->with(['departments' => $departments]);
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
            'idDepartment' => 'required',
            'descripcion' => 'required|max:200',
            'codigoUbigeo' => 'required|numeric|regex:/^[0-9]{4}$/',
        ]);

        Province::create($request->all());
        return redirect()
                ->route('province.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        $departments = Department::select('id', 'descripcion')->orderBy('codigoUbigeo','asc')->pluck('descripcion','id');
        return view('dashboard.province.edit')
                ->with([
                    'departments' => $departments,
                    'province' => $province,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $request->validate([
            'idDepartment' => 'required',
            'descripcion' => 'required|max:200',
            'codigoUbigeo' => 'required|numeric|regex:/^[0-9]{4}$/',
        ]);

        $province->update($request->all());
        return redirect()
                ->route('province.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy($province)
    {
        Province::find($province)->delete();
    }
}
