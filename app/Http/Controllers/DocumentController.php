<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('animal')->get();
        return response()->json($documents);
    }

    public function show($id)
    {
        $document = Document::with('animal')->findOrFail($id);
        return response()->json($document);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Document' => 'required|string|max:45',
            'idAnimal' => 'required|exists:animals,idAnimal'
        ]);

        $document = Document::create($validated);
        return response()->json($document, 201);
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Document' => 'sometimes|string|max:45',
            'idAnimal' => 'sometimes|exists:animals,idAnimal'
        ]);

        $document->update($validated);
        return response()->json($document);
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        return response()->json(null, 204);
    }
}
