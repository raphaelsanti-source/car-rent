<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;

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

//?? Resources
Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::get('/cars/made/{made}', [CarController::class, 'searchMade']);
Route::get('/cars/type/{type}', [CarController::class, 'searchType']);


//!! AUTH SECTION

//?? User's routes handling
Route::post('/usr/register', [UserAuthController::class, 'register']);
Route::post('/usr/login', [AdminAuthController::class, 'login']);

Route::group(['middleware' => ['auth:users']], function () {
    Route::post('/usr/logout', [UserAuthController::class, 'logout']);
});

//?? Admin's routes handling
Route::post('/adm/login', [AdminAuthController::class, 'login']);

Route::group(['middleware' => ['auth:admins']], function () {

    Route::post('/adm/register', [AdminAuthController::class, 'register']);
    Route::post('/adm/logout', [AdminAuthController::class, 'logout']);

    //?? Cars
    Route::post('/cars', [CarController::class, 'store']);
    Route::put('/cars/{id}', [CarController::class, 'update']);
    Route::delete('/cars/{id}', [CarController::class, 'destroy']);

    //?? Users
    Route::get('/usr/show', [UserController::class, 'index']);
    Route::get('/usr/show/{id}', [UserController::class, 'show']);
    Route::delete('/usr/show/{id}', [UserController::class, 'destroy']);
});
