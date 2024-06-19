<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = Director::all();
        return response()->json($directors);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id_project',
            'id_teacher' => 'required|exists:teachers,id_teacher',
            'id_position' => 'required|exists:positions,id_position',
        ]);

        $director = Director::create($request->all());
        return response()->json($director, 201);
    }

    public function show(Director $director)
    {
        return response()->json($director);
    }

    public function edit(Director $director)
    {
        //
    }

    public function update(Request $request, Director $director)
    {
        $request->validate([
            'id_project' => 'sometimes|required|exists:projects,id_project',
            'id_teacher' => 'sometimes|required|exists:teachers,id_teacher',
            'id_position' => 'sometimes|required|exists:positions,id_position',
        ]);

        $director->update($request->all());
        return response()->json($director);
    }

    public function destroy(Director $director)
    {
        $director->delete();
        return response()->json(null, 204);
    }
}