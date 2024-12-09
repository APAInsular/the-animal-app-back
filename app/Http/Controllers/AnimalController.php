<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with(['race', 'zone', 'documents', 'clinicalHistories', 'microchips', 'users', 'needs', 'feeding', 'care'])->get();
        return response()->json($animals);
    }

    public function show($id)
    {
        $animal = Animal::with(['race', 'zone', 'documents', 'clinicalHistories', 'microchips', 'users', 'needs', 'feeding', 'care'])->findOrFail($id);
        return response()->json($animal);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Description' => 'required|string|max:45',
            'Superpower' => 'nullable|string|max:45',
            'DateOfBirth' => 'nullable|date',
            'DateOfDeath' => 'nullable|date',
            'idRace' => 'required|exists:races,idRace',
            'idZone' => 'required|exists:zones,idZone'
        ]);

        $animal = Animal::create($validated);
        return response()->json($animal, 201);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $validated = $request->validate([
            'Description' => 'sometimes|string|max:45',
            'Superpower' => 'sometimes|string|max:45',
            'DateOfBirth' => 'sometimes|date',
            'DateOfDeath' => 'sometimes|date',
            'idRace' => 'sometimes|exists:races,idRace',
            'idZone' => 'sometimes|exists:zones,idZone'
        ]);

        $animal->update($validated);
        return response()->json($animal);
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return response()->json(null, 204);
    }
}
