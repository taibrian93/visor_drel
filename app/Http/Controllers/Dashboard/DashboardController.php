<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $populationCenter;
    private $college;
    private $user;

    public function __construct(){
        // $this->middleware('can:Leer')->only('home');
        $this->populationCenter = PopulationCenter::class;
        $this->college = College::class;
        $this->user = User::class;
    }

    // public function __construct()
    // {
    //     $this->middleware('can:Crear')->only('create','store');
        
    //     $this->middleware('can:Editar')->only('edit', 'update');
    //     $this->middleware('can:Eliminar')->only('destroy');
    // }

    public function home(){
        $populationCenters = $this->populationCenter::count();
        $colleges =  $this->college::count();
        $users = $this->user::count();
        //$user = User::find(Auth::user()->id);
        if(Auth::user()->can('Leer')){
            return view('dashboard.index')
                ->with([
                    'populationCenters' => $populationCenters,
                    'colleges' => $colleges,
                    'users' => $users,
                ]);
        } else{
            return redirect()->route('visor');
        }
        
    }
}
