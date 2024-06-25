<?php

namespace App\Http\Controllers;

use App\Models\Exam_schedule;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function index()
    {
        $schedules = Exam_schedule::all();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_time' => 'required|date_format:H:i',
            'exam_day' => 'required|date',
            'exam_room' => 'required|string|max:255',
            'exam_building' => 'required|string|max:255',
            'exam_group' => 'required|string|max:255',
            'year_published' => 'required|integer',
            'semester' => 'required|integer',
            'id_project' => 'required|exists:projects,id',
            'id_document' => 'required|exists:documents,id',
        ]);

        $schedule = Exam_schedule::create($request->all());
        return response()->json($schedule, 201);
    }

    public function show($id)
    {
        $schedule = Exam_schedule::findOrFail($id);
        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_time' => 'required|date_format:H:i',
            'exam_day' => 'required|date',
            'exam_room' => 'required|string|max:255',
            'exam_building' => 'required|string|max:255',
            'exam_group' => 'required|string|max:255',
            'year_published' => 'required|integer',
            'semester' => 'required|integer',
            'id_project' => 'required|exists:projects,id',
            'id_document' => 'required|exists:documents,id',
        ]);

        $schedule = Exam_schedule::findOrFail($id);
        $schedule->update($request->all());

        return response()->json($schedule, 200);
    }

    public function destroy($id)
    {
        $schedule = Exam_schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(null, 204);
    }
}