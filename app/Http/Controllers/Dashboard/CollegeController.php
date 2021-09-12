<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\District;
use App\Models\PopulationCenter;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollegeController extends Controller
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
        $provinces = Province::select('codigoUbigeo',DB::raw('CONCAT(descripcion, " - ", codigoUbigeo) AS descripcion'))->orderBy('codigoUbigeo','asc')->pluck('descripcion','codigoUbigeo');
        $districts = District::select('districts.codigoUbigeo',DB::raw('CONCAT(districts.descripcion, " - ", districts.codigoUbigeo) AS descripcion'))
                    ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id')
                    ->where('provinces.codigoUbigeo', '=', '1601')
                    ->orderBy('codigoUbigeo','asc')
                    ->pluck('descripcion','codigoUbigeo');
        $populationCenters = PopulationCenter::select('population_centers.codigoCentroPobladoMINEDU',DB::raw('CONCAT(population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                            ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                            ->where('districts.codigoUbigeo', '=', '160101')
                            ->orderBy('codigoUbigeoDistrito','asc')
                            ->pluck('descripcion','codigoCentroPobladoMINEDU');
        return view('dashboard.college.create')->with([
            'province' => $provinces,
            'district' => $districts,
            'populationCenters' => $populationCenters,
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
        $data = $request->except(['province', 'district']);
        //dd($data);
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
        $population_center = $college->population_center;
        $district = $population_center->district;
        $provinceCodigo = $district->province->codigoUbigeo;
        $provinceId = $district->province->codigoUbigeo;
        $districtId = $population_center->district->codigoUbigeo;
        //$college = $college->getAttributes();
        // $array = [
        //     'province' => $provinceId,
        //     'district' => $districtId,
        // ];
        $college->setAttribute('province', $provinceId);
        $college->setAttribute('district', $districtId);
        // $college = array_merge($college->getAttributes(),$array);
        // dd($college);
        $provinces = Province::select('codigoUbigeo',DB::raw('CONCAT(descripcion, " - ", codigoUbigeo) AS descripcion'))->orderBy('codigoUbigeo','asc')->pluck('descripcion','codigoUbigeo');
        $districts = District::select('districts.codigoUbigeo',DB::raw('CONCAT(districts.descripcion, " - ", districts.codigoUbigeo) AS descripcion'))
                    ->leftJoin('provinces', 'districts.idProvince', '=', 'provinces.id')
                    ->where('provinces.codigoUbigeo', '=', $provinceCodigo)
                    ->orderBy('codigoUbigeo','asc')
                    ->pluck('descripcion','codigoUbigeo');
        $populationCenters = PopulationCenter::select('population_centers.codigoCentroPobladoMINEDU',DB::raw('CONCAT(population_centers.descripcion, " - ", population_centers.codigoCentroPobladoMINEDU) AS descripcion'))
                    ->leftJoin('districts', 'population_centers.codigoUbigeoDistrito', '=', 'districts.codigoUbigeo')
                    ->where('districts.codigoUbigeo', '=', $districtId)
                    ->orderBy('codigoUbigeoDistrito','asc')
                    ->pluck('descripcion','codigoCentroPobladoMINEDU');
        return view('dashboard.college.edit')->with([
            'college' => $college,
            'province' => $provinces,
            'district' => $districts,
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
