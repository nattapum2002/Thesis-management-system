<?php

namespace App\Http\Controllers;

use App\Models\Confirm_teacher;
use Illuminate\Http\Request;

class ConfirmTeacherController extends Controller
{
    public function index()
    {
        $confirmTeachers = Confirm_teacher::all();
        return response()->json($confirmTeachers);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id_project',
            'id_document' => 'required|exists:documents,id_document',
            'id_teacher' => 'required|exists:teachers,id_teacher',
            'id_position' => 'required|exists:positions,id_position',
        ]);

        $confirmTeacher = Confirm_teacher::create($request->all());
        return response()->json($confirmTeacher, 201);
    }

    public function show(Confirm_teacher $confirmTeacher)
    {
        return response()->json($confirmTeacher);
    }

    public function edit(Confirm_teacher $confirmTeacher)
    {
        //
    }

    public function update(Request $request, Confirm_teacher $confirmTeacher)
    {
        $request->validate([
            'id_project' => 'sometimes|required|exists:projects,id_project',
            'id_document' => 'sometimes|required|exists:documents,id_document',
            'id_teacher' => 'sometimes|required|exists:teachers,id_teacher',
            'id_position' => 'sometimes|required|exists:positions,id_position',
        ]);

        $confirmTeacher->update($request->all());
        return response()->json($confirmTeacher);
    }

    public function destroy(Confirm_teacher $confirmTeacher)
    {
        $confirmTeacher->delete();
        return response()->json(null, 204);
    }
}