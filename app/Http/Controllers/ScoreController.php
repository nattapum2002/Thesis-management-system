<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::all();
        return response()->json($scores);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
            'id_student' => 'required|exists:members,id_student',
            'id_document' => 'required|exists:documents,id_document',
            'id_comment_list' => 'required|exists:comment_lists,id_comment_list',
            'id_teacher' => 'required|exists:teachers,id_teacher',
            'id_position' => 'required|exists:positions,id_position',
        ]);

        $score = Score::create($request->all());
        return response()->json($score, 201);
    }

    public function show(Score $score)
    {
        return response()->json($score);
    }

    public function edit(Score $score)
    {
        //
    }

    public function update(Request $request, Score $score)
    {
        $request->validate([
            'score' => 'sometimes|required|integer',
            'id_student' => 'sometimes|required|exists:members,id_student',
            'id_document' => 'sometimes|required|exists:documents,id_document',
            'id_comment_list' => 'sometimes|required|exists:comment_lists,id_comment_list',
            'id_teacher' => 'sometimes|required|exists:teachers,id_teacher',
            'id_position' => 'sometimes|required|exists:positions,id_position',
        ]);

        $score->update($request->all());
        return response()->json($score);
    }

    public function destroy(Score $score)
    {
        $score->delete();
        return response()->json(null, 204);
    }
}