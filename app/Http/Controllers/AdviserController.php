<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Http\Request;

class AdviserController extends Controller
{
    public function index()
    {
        $advisers = Adviser::all();
        return response()->json($advisers);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'adviser_status' => 'required|string|max:255',
            'id_project' => 'required|exists:projects,id_project',
            'id_teacher' => 'required|exists:teachers,id_teacher',
            'id_position' => 'required|exists:positions,id_position',
        ]);

        $adviser = Adviser::create($request->all());
        return response()->json($adviser, 201);
    }

    public function show(Adviser $adviser)
    {
        return response()->json($adviser);
    }

    public function edit(Adviser $adviser)
    {
        //
    }

    public function update(Request $request, Adviser $adviser)
    {
        $request->validate([
            'adviser_status' => 'sometimes|required|string|max:255',
            'id_project' => 'sometimes|required|exists:projects,id_project',
            'id_teacher' => 'sometimes|required|exists:teachers,id_teacher',
            'id_position' => 'sometimes|required|exists:positions,id_position',
        ]);

        $adviser->update($request->all());
        return response()->json($adviser);
    }

    public function destroy(Adviser $adviser)
    {
        $adviser->delete();
        return response()->json(null, 204);
    }
}