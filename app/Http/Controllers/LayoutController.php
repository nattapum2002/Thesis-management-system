<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $layouts = Layout::all();
        return response()->json($layouts);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'layout_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $layout = Layout::create($request->all());
        return response()->json($layout, 201);
    }

    public function show(Layout $layout)
    {
        return response()->json($layout);
    }

    public function edit(Layout $layout)
    {
        //
    }

    public function update(Request $request, Layout $layout)
    {
        $request->validate([
            'layout_name' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|file|mimes:pdf,doc,docx',
        ]);

        $layout->update($request->all());
        return response()->json($layout);
    }

    public function destroy(Layout $layout)
    {
        $layout->delete();
        return response()->json(null, 204);
    }
}