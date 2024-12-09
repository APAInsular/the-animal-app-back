<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with(['clinicalHistory', 'medicines'])->get();
        return response()->json($treatments);
    }

    public function show($id)
    {
        $treatment = Treatment::with(['clinicalHistory', 'medicines'])->findOrFail($id);
        return response()->json($treatment);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:45',
            'Frequency' => 'required|string|max:45',
            'Dose' => 'required|string|max:45',
            'Comments' => 'nullable|string',
            'idClinicalHistory' => 'required|exists:clinical_histories,idClinicalHistory'
        ]);

        $treatment = Treatment::create($validated);
        return response()->json($treatment, 201);
    }

    public function update(Request $request, $id)
    {
        $treatment = Treatment::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'sometimes|string|max:45',
            'Frequency' => 'sometimes|string|max:45',
            'Dose' => 'sometimes|string|max:45',
            'Comments' => 'sometimes|string',
            'idClinicalHistory' => 'sometimes|exists:clinical_histories,idClinicalHistory'
        ]);

        $treatment->update($validated);
        return response()->json($treatment);
    }

    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();
        return response()->json(null, 204);
    }
}
