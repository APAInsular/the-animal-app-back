<?php

namespace App\Http\Controllers;

use App\Models\Care;
use Illuminate\Http\Request;

class CareController extends Controller
{
    public function index()
    {
        $cares = Care::with('animals')->get();
        return response()->json($cares);
    }

    public function show($id)
    {
        $care = Care::with('animals')->findOrFail($id);
        return response()->json($care);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string',
        ]);

        $care = Care::create($validated);
        return response()->json($care, 201);
    }

    public function update(Request $request, $id)
    {
        $care = Care::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string'
        ]);

        $care->update($validated);
        return response()->json($care);
    }

    public function destroy($id)
    {
        $care = Care::findOrFail($id);
        $care->delete();
        return response()->json(null, 204);
    }
}
