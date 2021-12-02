<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MadeController;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cars', [CarController::class, 'store']);


//?? Resources
Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::get('/cars/made/{made}', [CarController::class, 'searchMade']);
Route::get('/cars/type/{type}', [CarController::class, 'searchType']);


//!! AUTH SECTION

//?? User's routes handling
Route::post('/usr/register', [UserAuthController::class, 'register']);
Route::post('/usr/login', [UserAuthController::class, 'login']);

Route::group(['middleware' => ['auth:users']], function () {
    Route::post('/usr/logout', [UserAuthController::class, 'logout']);

    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::post('/user_reservations', [ReservationController::class, 'showUsersReservations']);
    Route::put('/change_reservation', [ReservationController::class, 'changeStatus']);
});

//?? Admin's routes handling
Route::post('/adm/login', [AdminAuthController::class, 'login']);

Route::group(['middleware' => ['auth:admins']], function () {

    Route::post('/adm/logout', [AdminAuthController::class, 'logout']);
    Route::post('/adm/register', [AdminAuthController::class, 'register']);


    //?? Cars
    Route::post('/cars', [CarController::class, 'store']);
    Route::put('/cars/{id}', [CarController::class, 'update']);
    Route::delete('/cars/{id}', [CarController::class, 'destroy']);
    //?? Cars mades & types
    Route::post('/cars/types', [TypeController::class, 'store']);
    Route::post('/cars/mades', [MadeController::class, 'store']);

    //?? Users
    Route::get('/usr/show', [UserController::class, 'index']);
    Route::get('/usr/show/{id}', [UserController::class, 'show']);
    Route::delete('/usr/show/{id}', [UserController::class, 'destroy']);

    //?? Reservations
    Route::put('/usr/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/usr/reservations/{id}', [ReservationController::class, 'destroy']);
});
