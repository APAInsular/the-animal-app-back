<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        $races = Race::with('species')->get();
        return response()->json($races);
    }

    public function show($id)
    {
        $race = Race::with('species')->findOrFail($id);
        return response()->json($race);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:45',
            'species_id' => 'required|exists:species,idSpecies'
        ]);

        $race = Race::create([
            'Name' => $validated['Name'],
            'idSpecies' => $validated['species_id']
        ]);

        return response()->json($race, 201);
    }

    public function update(Request $request, $id)
    {
        $race = Race::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'sometimes|string|max:45',
            'species_id' => 'sometimes|exists:species,idSpecies'
        ]);

        $race->update([
            'Name' => $validated['Name'] ?? $race->Name,
            'idSpecies' => $validated['species_id'] ?? $race->idSpecies
        ]);

        return response()->json($race);
    }

    public function destroy($id)
    {
        $race = Race::findOrFail($id);
        $race->delete();
        return response()->json(null, 204);
    }
}
