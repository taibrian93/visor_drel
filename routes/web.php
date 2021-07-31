<?php
use App\Http\Controllers\Dashboard\UserController;

use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\DistrictController;
use App\Http\Controllers\Dashboard\PopulaTionCenterController;
use App\Http\Controllers\Dashboard\ProvinceController;
use App\Http\Controllers\Dashboard\CollegeController;
use App\Http\Controllers\Dashboard\DashboardController;
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
    
    Route::post('getColleges', [VisorController::class, 'getColleges']);
    Route::post('populationCenters', [VisorController::class, 'populationCenters']); 

});