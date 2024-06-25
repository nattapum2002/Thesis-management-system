<?php

namespace App\Http\Controllers;

use App\Models\Student_project;
use Illuminate\Http\Request;

class StudentProjectController extends Controller
{
    public function index()
    {
        $studentProjects = Student_project::all();
        return response()->json($studentProjects);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project' => 'required|exists:projects,id_project',
            'id_student' => 'required|exists:members,id_student',
            'project_status' => 'required|string|max:255',
        ]);

        $studentProject = Student_project::create($request->all());
        return response()->json($studentProject, 201);
    }

    public function show(Student_project $studentProject)
    {
        return response()->json($studentProject);
    }

    public function edit(Student_project $studentProject)
    {
        //
    }

    public function update(Request $request, Student_project $studentProject)
    {
        $request->validate([
            'id_project' => 'sometimes|required|exists:projects,id_project',
            'id_student' => 'sometimes|required|exists:members,id_student',
            'project_status' => 'sometimes|required|string|max:255',
        ]);

        $studentProject->update($request->all());
        return response()->json($studentProject);
    }

    public function destroy(Student_project $studentProject)
    {
        $studentProject->delete();
        return response()->json(null, 204);
    }
}