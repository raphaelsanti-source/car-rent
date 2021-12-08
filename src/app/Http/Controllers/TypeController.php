<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return $types;
    }
    public function store(Request $request)
    {
        $request->validate([
            'type'
        ]);
        return Type::create($request->all());
    }
}
