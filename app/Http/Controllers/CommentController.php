<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'id_project' => 'required|exists:projects,id_project',
            'id_document' => 'required|exists:documents,id_document',
            'id_comment_list' => 'required|exists:comment_lists,id_comment_list',
            'id_teacher' => 'required|exists:teachers,id_teacher',
            'id_position' => 'required|exists:positions,id_position',
        ]);

        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
            'id_project' => 'sometimes|required|exists:projects,id_project',
            'id_document' => 'sometimes|required|exists:documents,id_document',
            'id_comment_list' => 'sometimes|required|exists:comment_lists,id_comment_list',
            'id_teacher' => 'sometimes|required|exists:teachers,id_teacher',
            'id_position' => 'sometimes|required|exists:positions,id_position',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(null, 204);
    }
}