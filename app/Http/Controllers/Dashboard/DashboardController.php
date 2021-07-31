<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\PopulationCenter;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $populationCenter;
    private $college;
    private $user;

    public function __construct(){
        $this->populationCenter = PopulationCenter::class;
        $this->college = College::class;
        $this->user = User::class;
    }

    public function home(){
        $populationCenters = $this->populationCenter::count();
        $colleges =  $this->college::count();
        $users = $this->user::count();
        return view('dashboard.index')
                ->with([
                    'populationCenters' => $populationCenters,
                    'colleges' => $colleges,
                    'users' => $users,
                ]);
    }
}
