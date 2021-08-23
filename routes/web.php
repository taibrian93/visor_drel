<?php
use App\Http\Controllers\Dashboard\UserController;

use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\DistrictController;
use App\Http\Controllers\Dashboard\PopulaTionCenterController;
use App\Http\Controllers\Dashboard\ProvinceController;
use App\Http\Controllers\Dashboard\CollegeController;
use App\Http\Controllers\Dashboard\ConveyanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MobilityController;
use App\Http\Controllers\Dashboard\RouteController;
use App\Http\Controllers\Dashboard\TrajectorieController;
use App\Http\Controllers\Dashboard\TypeTransportationController;
use App\Http\Controllers\Dashboard\VisorController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'dashboard'], function () {
    
    Route::get('/', [DashboardController::class, 'home']);

    Route::get('/visor', function () {
        return view('dashboard.visor.index');
    });

    Route::resource('user', UserController::class);

    Route::resource('department', DepartmentController::class);
    Route::resource('province', ProvinceController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('populationCenter', PopulaTionCenterController::class);

    Route::resource('college', CollegeController::class);

    Route::resource('conveyance', ConveyanceController::class);
    
    Route::resource('typeTransportation', TypeTransportationController::class);
    Route::post('typeTransportation/getTypeTransportation', [TypeTransportationController::class, 'getTypeTransportation'])->name('typeTransportation.getTypeTransportation');

    Route::resource('route', RouteController::class);
    Route::get('route/{route}/trajectorie', [RouteController::class, 'trajectorie'])->name('route.trajectorie');
    Route::post('route/getColleges', [RouteController::class, 'getColleges'])->name('route.getColleges');

    Route::resource('trajectorie', TrajectorieController::class);
    Route::get('trajectorie/{trajectorie}/mobility', [TrajectorieController::class, 'mobility'])->name('trajectorie.mobility');
    Route::get('trajectorie/{trajectorie}/mobility/{mobility}', [TrajectorieController::class, 'editMobility'])->name('trajectorie.editMobility');
    

    Route::resource('mobility', MobilityController::class);
    
    
    Route::post('getColleges', [VisorController::class, 'getColleges']);
    Route::post('populationCenters', [VisorController::class, 'populationCenters']); 
    Route::post('getCollege', [VisorController::class, 'getCollege']);

});

Route::get('dashboard/{idCollege}/route', [RouteController::class, 'getRouteCollege']);