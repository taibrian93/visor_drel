<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Conveyance;
use App\Models\Mobility;
use App\Models\TypeTransportation;
use Illuminate\Http\Request;

class TypeTransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeTransportation = TypeTransportation::class;
        return view('dashboard.type_transportation.index')
                ->with(['typeTransportation' => $typeTransportation]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conveyances = Conveyance::select('id', 'descripcion')->orderBy('id','asc')->pluck('descripcion','id');
        return view('dashboard.type_transportation.create')
            ->with(['conveyances' => $conveyances]);
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
            'idConveyance' => 'required',
            'descripcion' => 'required|max:200',
        ]);

        TypeTransportation::create($request->all());
        return redirect()
                ->route('typeTransportation.index')
                ->with([
                    'message' => 'El registro se agrego satisfactoriamente!',
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeTransportation  $typeTransportation
     * @return \Illuminate\Http\Response
     */
    public function show(TypeTransportation $typeTransportation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeTransportation  $typeTransportation
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeTransportation $typeTransportation)
    {
        $conveyances = Conveyance::select('id', 'descripcion')->orderBy('id','asc')->pluck('descripcion','id');
        return view('dashboard.type_transportation.edit')->with([
            'conveyances' => $conveyances,
            'typeTransportation' => $typeTransportation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeTransportation  $typeTransportation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeTransportation $typeTransportation)
    {
        $request->validate([
            'idConveyance' => 'required',
            'descripcion' => 'required|max:200',
        ]);

        $typeTransportation->update($request->all());
        return redirect()
                ->route('typeTransportation.index')
                ->with([
                    'message' => 'El registro se edito satisfactoriamente!',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeTransportation  $typeTransportation
     * @return \Illuminate\Http\Response
     */
    public function destroy($typeTransportation)
    {
        TypeTransportation::find($typeTransportation)->delete();
    }

    public function getTypeTransportation(Request $request){
        $getArray = Mobility::where('idTrajectorie', $request->idTrajectorie)->pluck('idTypeTransportation')->toArray();
        $transportation = TypeTransportation::where('idConveyance',$request->idConveyance)
                                            ->whereNotIn('id', $getArray);
        return response()->json($transportation->get());
    }
}
