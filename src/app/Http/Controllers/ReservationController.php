<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'car_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        return Reservation::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $car = Reservation::find($id);
        $car->update($request->all());
        return $car;
    }

    public function destroy($id)
    {
        return Reservation::destroy($id);
    }

    public function showUsersReservations(Request $request)
    {
        $request->validate([
            'user_id',
        ]);
        return Reservation::where('user_id', $request['user_id'])
            ->join('cars', 'car_id', '=', 'cars.id')
            ->select('reservations.*', 'cars.made', 'cars.model', 'cars.year', 'cars.desc')
            ->get();
    }
    public function changeStatus(Request $request)
    {
        $request->validate([
            'id',
            'operation'
        ]);
        $car = Reservation::find($request['id']);
        $car->update(['status' => $request['operation']]);
    }
}
