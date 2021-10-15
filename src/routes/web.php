<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard']);
    Route::get('/dashboard/cars', [PageController::class, 'dashboardCars']);
    // Route::get('/dashboard/cars/{id}', [PageController::class, 'dashboardCar']);
    // Route::get('/dashboard/cars/mades/{made}', [PageController::class, 'dashboardMades']);
    // Route::get('/dashboard/cars/types/{type}', [PageController::class, 'dashboardTypes']);
});
