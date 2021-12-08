<?php

namespace App\Http\Controllers;

use App\Models\Made;
use Illuminate\Http\Request;

class MadeController extends Controller
{
    public function index()
    {
        $types = Made::all();
        return $types;
    }
    public function store(Request $request)
    {
        $request->validate([
            'made'
        ]);
        return Made::create($request->all());
    }
}
