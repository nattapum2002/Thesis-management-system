<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return response()->json($levels);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
        ]);

        $level = Level::create($request->all());
        return response()->json($level, 201);
    }

    public function show(Level $level)
    {
        return response()->json($level);
    }

    public function edit(Level $level)
    {
        //
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
        ]);

        $level->update($request->all());
        return response()->json($level);
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return response()->json(null, 204);
    }
}