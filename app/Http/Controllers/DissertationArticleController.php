<?php

namespace App\Http\Controllers;

use App\Models\Dissertation_article;
use Illuminate\Http\Request;

class DissertationArticleController extends Controller
{
    public function index()
    {
        $dissertationArticles = Dissertation_article::all();
        return response()->json($dissertationArticles);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_student' => 'required|exists:members,id_student',
            'details' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $dissertationArticle = Dissertation_article::create($request->all());
        return response()->json($dissertationArticle, 201);
    }

    public function show(Dissertation_article $dissertationArticle)
    {
        return response()->json($dissertationArticle);
    }

    public function edit(Dissertation_article $dissertationArticle)
    {
        //
    }

    public function update(Request $request, Dissertation_article $dissertationArticle)
    {
        $request->validate([
            'id_student' => 'sometimes|required|exists:members,id_student',
            'details' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|file|mimes:pdf,doc,docx',
        ]);

        $dissertationArticle->update($request->all());
        return response()->json($dissertationArticle);
    }

    public function destroy(Dissertation_article $dissertationArticle)
    {
        $dissertationArticle->delete();
        return response()->json(null, 204);
    }
}