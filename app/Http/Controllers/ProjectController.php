<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name_th' => 'required|string|max:255',
            'project_name_en' => 'required|string|max:255',
            'project_status' => 'required|string|max:255',
        ]);

        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return response()->json($project);
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name_th' => 'sometimes|required|string|max:255',
            'project_name_en' => 'sometimes|required|string|max:255',
            'project_status' => 'sometimes|required|string|max:255',
        ]);

        $project->update($request->all());
        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}