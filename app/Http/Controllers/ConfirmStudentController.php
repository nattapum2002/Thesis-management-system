<?php

namespace App\Http\Controllers;

use App\Models\Confirm_student;
use Illuminate\Http\Request;

class ConfirmStudentController extends Controller
{
    public function index()
    {
        $confirmStudents = Confirm_student::all();
        return response()->json($confirmStudents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_student' => 'required|exists:members,id_student',
            'id_document' => 'required|exists:documents,id_document',
            'confirm_status' => 'required|boolean',
        ]);

        $confirmStudent = Confirm_student::create($request->all());
        return response()->json($confirmStudent, 201);
    }

    public function show($id)
    {
        $confirmStudent = Confirm_student::findOrFail($id);
        return response()->json($confirmStudent);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_student' => 'sometimes|required|exists:members,id_student',
            'id_document' => 'sometimes|required|exists:documents,id_document',
            'confirm_status' => 'sometimes|required|boolean',
        ]);

        $confirmStudent = Confirm_student::findOrFail($id);
        $confirmStudent->update($request->all());

        return response()->json($confirmStudent, 200);
    }

    public function destroy($id)
    {
        $confirmStudent = Confirm_student::findOrFail($id);
        $confirmStudent->delete();

        return response()->json(null, 204);
    }
}