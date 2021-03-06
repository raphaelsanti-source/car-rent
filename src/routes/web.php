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

//?? User xd
Route::get('/', [PageController::class, 'home']);

//?? Admin 😎

//!! Auth
Route::get('/admin', [PageController::class, 'adminLogin']);
Route::get('/admin/logout', [PageController::class, 'adminLogout']);

//?? Functionals
Route::get('/admin/dashboard', [PageController::class, 'dashboard']);

Route::get('/admin/cars', [PageController::class, 'dashboardCars']);
Route::get('/admin/cars/{id}', [PageController::class, 'dashboardCar']);

Route::get('/admin/reservations', [PageController::class, 'dashboardReservations']);
Route::get('/admin/reservations/{id}', [PageController::class, 'dashboardReservation']);

Route::get('/admin/users', [PageController::class, 'dashboardUsers']);
Route::get('/admin/users/{id}', [PageController::class, 'dashboardUser']);
