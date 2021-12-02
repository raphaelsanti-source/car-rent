<?php

namespace App\Http\Controllers;

use App\Models\Made;
use Illuminate\Http\Request;

class MadeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'made'
        ]);
        return Made::create($request->all());
    }
}
