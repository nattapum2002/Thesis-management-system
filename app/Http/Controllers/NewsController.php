<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return response()->json($news);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'details' => 'required|string',
            'type' => 'required|in:general,topic',
            'status' => 'boolean',
            'id_teacher' => 'required|exists:teachers,id_teacher',
        ]);

        $news = News::create($request->all());
        return response()->json($news, 201);
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'details' => 'required|string',
            'type' => 'required|in:general,topic',
            'status' => 'boolean',
            'id_teacher' => 'required|exists:teachers,id_teacher',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return response()->json($news, 200);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json(null, 204);
    }
}