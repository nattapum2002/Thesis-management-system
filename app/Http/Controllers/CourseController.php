<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
        ]);

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
        ]);

        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}