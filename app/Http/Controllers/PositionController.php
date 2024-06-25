<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
        ]);

        $position = Position::create($request->all());
        return response()->json($position, 201);
    }

    public function show(Position $position)
    {
        return response()->json($position);
    }

    public function edit(Position $position)
    {
        //
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'position' => 'sometimes|required|string|max:255',
        ]);

        $position->update($request->all());
        return response()->json($position);
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json(null, 204);
    }
}