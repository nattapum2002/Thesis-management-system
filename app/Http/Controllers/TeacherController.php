<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'academic_position' => 'required|string|max:255',
            'educational_qualification' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'user_type' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'tel' => 'required|string|max:255|unique:teachers',
            'username' => 'required|string|max:255|unique:teachers',
            'password' => 'required|string|min:8',
            'account_status' => 'required|string|max:255',
        ]);

        $teacher = Teacher::create($request->all());
        return response()->json($teacher, 201);
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    public function edit(Teacher $teacher)
    {
        //
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'academic_position' => 'sometimes|required|string|max:255',
            'educational_qualification' => 'sometimes|required|string|max:255',
            'branch' => 'sometimes|required|string|max:255',
            'user_type' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:teachers,email,' . $teacher->id_teacher,
            'tel' => 'sometimes|required|string|max:255|unique:teachers,tel,' . $teacher->id_teacher,
            'username' => 'sometimes|required|string|max:255|unique:teachers,username,' . $teacher->id_teacher,
            'password' => 'sometimes|nullable|string|min:8',
            'account_status' => 'sometimes|required|string|max:255',
        ]);

        $teacher->update($request->all());
        return response()->json($teacher);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}