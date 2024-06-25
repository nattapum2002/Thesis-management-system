<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return response()->json($documents);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
            'status' => 'required|string|max:255',
        ]);

        $document = Document::create($request->all());
        return response()->json($document, 201);
    }

    public function show(Document $document)
    {
        return response()->json($document);
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'document' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'details' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|file|mimes:pdf,doc,docx',
            'status' => 'sometimes|required|string|max:255',
        ]);

        $document->update($request->all());
        return response()->json($document);
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return response()->json(null, 204);
    }
}