<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type'
        ]);
        return Type::create($request->all());
    }
}
