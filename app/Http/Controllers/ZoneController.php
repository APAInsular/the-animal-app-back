<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::with(['animals', 'tasks'])->get();
        return response()->json($zones);
    }

    public function show($id)
    {
        $zone = Zone::with(['animals', 'tasks'])->findOrFail($id);
        return response()->json($zone);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string'
        ]);

        $zone = Zone::create($validated);
        return response()->json($zone, 201);
    }

    public function update(Request $request, $id)
    {
        $zone = Zone::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string'
        ]);

        $zone->update($validated);
        return response()->json($zone);
    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return response()->json(null, 204);
    }
}
