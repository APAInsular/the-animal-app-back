<?php

namespace App\Http\Controllers;

use App\Models\Needs;
use Illuminate\Http\Request;

class NeedsController extends Controller
{
    public function index()
    {
        $needs = Needs::with('animals')->get();
        return response()->json($needs);
    }

    public function show($id)
    {
        $need = Needs::with('animals')->findOrFail($id);
        return response()->json($need);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string'
        ]);

        $need = Needs::create($validated);
        return response()->json($need, 201);
    }

    public function update(Request $request, $id)
    {
        $need = Needs::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string'
        ]);

        $need->update($validated);
        return response()->json($need);
    }

    public function destroy($id)
    {
        $need = Needs::findOrFail($id);
        $need->delete();
        return response()->json(null, 204);
    }
}
