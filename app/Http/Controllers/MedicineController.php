<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('treatment')->get();
        return response()->json($medicines);
    }

    public function show($id)
    {
        $medicine = Medicine::with('treatment')->findOrFail($id);
        return response()->json($medicine);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:45',
            'Description' => 'nullable|string',
            'idTreatment' => 'required|exists:treatments,idTreatment'
        ]);

        $medicine = Medicine::create($validated);
        return response()->json($medicine, 201);
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string',
            'idTreatment' => 'sometimes|exists:treatments,idTreatment'
        ]);

        $medicine->update($validated);
        return response()->json($medicine);
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return response()->json(null, 204);
    }
}
