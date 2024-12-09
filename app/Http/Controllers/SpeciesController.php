<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {
        $species = Species::all();
        return response()->json($species);
    }

    public function show($id)
    {
        $species = Species::findOrFail($id);
        return response()->json($species);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:45',
        ]);

        $species = Species::create($validated);
        return response()->json($species, 201);
    }

    public function update(Request $request, $id)
    {
        $species = Species::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'required|string|max:45',
        ]);

        $species->update($validated);
        return response()->json($species);
    }

    public function destroy($id)
    {
        $species = Species::findOrFail($id);
        $species->delete();
        return response()->json(null, 204);
    }
}
