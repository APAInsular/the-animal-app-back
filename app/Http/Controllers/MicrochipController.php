<?php

namespace App\Http\Controllers;

use App\Models\Microchip;
use Illuminate\Http\Request;

class MicrochipController extends Controller
{
    public function index()
    {
        $microchips = Microchip::with('animal')->get();
        return response()->json($microchips);
    }

    public function show($id)
    {
        $microchip = Microchip::with('animal')->findOrFail($id);
        return response()->json($microchip);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'NumChip' => 'required|integer',
            'idAnimal' => 'required|exists:animals,idAnimal'
        ]);

        $microchip = Microchip::create($validated);
        return response()->json($microchip, 201);
    }

    public function update(Request $request, $id)
    {
        $microchip = Microchip::findOrFail($id);

        $validated = $request->validate([
            'NumChip' => 'sometimes|integer',
            'idAnimal' => 'sometimes|exists:animals,idAnimal'
        ]);

        $microchip->update($validated);
        return response()->json($microchip);
    }

    public function destroy($id)
    {
        $microchip = Microchip::findOrFail($id);
        $microchip->delete();
        return response()->json(null, 204);
    }
}
