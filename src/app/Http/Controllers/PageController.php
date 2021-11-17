<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('pages.index');
    }

    public function dashboardCars()
    {
        $cars = Car::all();
        return view('pages.cars')->with('cars', $cars);
    }

    public function dashboardCar($id)
    {
        $car = Car::find($id);
        return view('pages.car')->with('car', $car);
    }
}
