<?php

namespace App\Http\Controllers;

use App\Models\Feeding;
use Illuminate\Http\Request;

class FeedingController extends Controller
{
    public function index()
    {
        $feedings = Feeding::with('animals')->get();
        return response()->json($feedings);
    }

    public function show($id)
    {
        $feeding = Feeding::with('animals')->findOrFail($id);
        return response()->json($feeding);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string',
        ]);

        $feeding = Feeding::create($validated);
        return response()->json($feeding, 201);
    }

    public function update(Request $request, $id)
    {
        $feeding = Feeding::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string'
        ]);

        $feeding->update($validated);
        return response()->json($feeding);
    }

    public function destroy($id)
    {
        $feeding = Feeding::findOrFail($id);
        $feeding->delete();
        return response()->json(null, 204);
    }
}
