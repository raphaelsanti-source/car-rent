<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Car::all();
        return DB::table('cars')
            ->join('types', 'type_id', '=', 'types.id')
            ->join('mades', 'made_id', '=', 'mades.id')
            ->select('cars.*', 'mades.made', 'types.type')
            ->get();
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
            'made_id' => 'required',
            'model' => 'required',
            'year' => 'required',
            'type_id' => 'required',
            'price' => 'required',
        ]);
        return Car::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Car::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $car->update($request->all());
        return $car;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Car::destroy($id);
    }

    /**
     * Search for a specified car made.
     *
     * @param  string  $made
     * @return \Illuminate\Http\Response
     */
    public function searchMade($made)
    {
        return Car::where('made', $made)->get();
    }

    /**
     * Search for a specified car type.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function searchType($type)
    {
        return Car::where('type', $type)->get();
    }
}
