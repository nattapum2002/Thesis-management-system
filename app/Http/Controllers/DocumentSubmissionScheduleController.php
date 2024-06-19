<?php

namespace App\Http\Controllers;

use App\Models\Document_submission_schedule;
use Illuminate\Http\Request;

class DocumentSubmissionScheduleController extends Controller
{
    public function index()
    {
        $schedules = Document_submission_schedule::all();
        return response()->json($schedules);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'time_submission' => 'required|date_format:H:i',
            'date_submission' => 'required|date',
            'year_submission' => 'required|integer',
            'id_document' => 'required|exists:documents,id_document',
        ]);

        $schedule = Document_submission_schedule::create($request->all());
        return response()->json($schedule, 201);
    }

    public function show(Document_submission_schedule $schedule)
    {
        return response()->json($schedule);
    }

    public function edit(Document_submission_schedule $schedule)
    {
        //
    }

    public function update(Request $request, Document_submission_schedule $schedule)
    {
        $request->validate([
            'time_submission' => 'sometimes|required|date_format:H:i',
            'date_submission' => 'sometimes|required|date',
            'year_submission' => 'sometimes|required|integer',
            'id_document' => 'sometimes|required|exists:documents,id_document',
        ]);

        $schedule->update($request->all());
        return response()->json($schedule);
    }

    public function destroy(Document_submission_schedule $schedule)
    {
        $schedule->delete();
        return response()->json(null, 204);
    }
}