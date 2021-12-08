<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Reservation;
use stdClass;

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

    public function showUsersReservations($id)
    {

        return DB::table('reservations')
            ->join('cars', 'car_id', '=', 'cars.id')
            ->join('mades', 'cars.made_id', '=', 'mades.id')
            ->select('reservations.*', 'cars.made_id', 'cars.model', 'cars.year', 'cars.desc', 'mades.made')
            ->get();
    }

    public function checkAvailability($id)
    {
        $response = new stdClass();
        $response->taken = false;
        $response->queue = false;
        $reservations = DB::table('reservations')
            ->select('*')
            ->where('car_id', $id)
            ->get();
        $today = date('Y-m-d');
        $arr = [];
        foreach ($reservations as $item) {
            $start_date = $item->start_date;
            $end_date = $item->end_date;
            $start_date = substr($start_date, 0, 10);
            $end_date = substr($end_date, 0, 10);
            if ($start_date < $today && $end_date > $today && ($item->status == 'accepted' || $item->status == 'ongoing')) {
                $response->taken = true;
                break;
            }
            // $payload = new stdClass();
            // $payload->uno = $start_date;
            // $payload->duo = $end_date;
            // array_push($arr, $payload);
        }
        if (!$response->taken) {
            foreach ($reservations as $item) {
                $start_date = $item->start_date;
                $end_date = $item->end_date;
                $start_date = substr($start_date, 0, 10);
                $end_date = substr($end_date, 0, 10);
                if ($start_date < $today && $end_date > $today && $item->status == 'waiting') {
                    $response->queue = true;
                    break;
                }
                // $payload = new stdClass();
                // $payload->uno = $start_date;
                // $payload->duo = $end_date;
                // array_push($arr, $payload);
            }
        }
        return $response;
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
