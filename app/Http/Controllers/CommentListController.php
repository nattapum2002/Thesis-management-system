<?php

namespace App\Http\Controllers;

use App\Models\Comment_list;
use Illuminate\Http\Request;

class CommentListController extends Controller
{
    public function index()
    {
        $commentLists = Comment_list::all();
        return response()->json($commentLists);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment_list' => 'required|string|max:255',
        ]);

        $commentList = Comment_list::create($request->all());
        return response()->json($commentList, 201);
    }

    public function show(Comment_list $commentList)
    {
        return response()->json($commentList);
    }

    public function edit(Comment_list $commentList)
    {
        //
    }

    public function update(Request $request, Comment_list $commentList)
    {
        $request->validate([
            'comment_list' => 'sometimes|required|string|max:255',
        ]);

        $commentList->update($request->all());
        return response()->json($commentList);
    }

    public function destroy(Comment_list $commentList)
    {
        $commentList->delete();
        return response()->json(null, 204);
    }
}