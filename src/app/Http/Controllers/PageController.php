<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Made;
use App\Models\Type;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //?? Main user view
    public function home()
    {
        return view('home');
    }

    //!! Admin auth views
    public function adminLogin()
    {
        return view('admin.login');
    }

    public function adminLogout()
    {
        return view('admin.logout');
    }

    //?? Admin functional views
    public function dashboard()
    {
        return view('admin.index');
    }

    public function dashboardCars()
    {
        $cars = DB::table('cars')
            ->join('types', 'type_id', '=', 'types.id')
            ->join('mades', 'made_id', '=', 'mades.id')
            ->select('cars.*', 'mades.made', 'types.type')
            ->get();
        $types = Type::all();
        $mades = Made::all();
        return view('admin.cars')
            ->with('cars', $cars)
            ->with('types', $types)
            ->with('mades', $mades);
    }

    public function dashboardCar($id)
    {
        $car = Car::find($id);
        $types = Type::all();
        $mades = Made::all();
        return view('admin.car')
            ->with('types', $types)
            ->with('mades', $mades)
            ->with('car', $car);
    }

    public function dashboardReservations()
    {
        $reservations = Reservation::all();
        return view('admin.reservations')
            ->with('reservations', $reservations);
    }

    public function dashboardReservation($id)
    {
        $reservation = Reservation::find($id);
        return view('admin.reservation')
            ->with('reservation', $reservation);
    }

    public function dashboardUsers()
    {
        $users = User::all();
        return view('admin.users')
            ->with('users', $users);
    }

    public function dashboardUser($id)
    {
        $user = User::find($id);
        return view('admin.user')
            ->with('user', $user);
    }
}
