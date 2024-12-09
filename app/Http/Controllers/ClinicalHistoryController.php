<?php

namespace App\Http\Controllers;

use App\Models\ClinicalHistory;
use Illuminate\Http\Request;

class ClinicalHistoryController extends Controller
{
    public function index()
    {
        $histories = ClinicalHistory::with(['animal', 'treatments'])->get();
        return response()->json($histories);
    }

    public function show($id)
    {
        $history = ClinicalHistory::with(['animal', 'treatments'])->findOrFail($id);
        return response()->json($history);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string',
            'idAnimal' => 'required|exists:animals,idAnimal'
        ]);

        $history = ClinicalHistory::create($validated);
        return response()->json($history, 201);
    }

    public function update(Request $request, $id)
    {
        $history = ClinicalHistory::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string',
            'idAnimal' => 'sometimes|exists:animals,idAnimal'
        ]);

        $history->update($validated);
        return response()->json($history);
    }

    public function destroy($id)
    {
        $history = ClinicalHistory::findOrFail($id);
        $history->delete();
        return response()->json(null, 204);
    }
}
