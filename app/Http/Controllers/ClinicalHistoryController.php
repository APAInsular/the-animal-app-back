<?php

namespace App\Http\Controllers;

use App\Models\ClinicalHistory;

use Illuminate\Http\Request;

class ClinicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las historias clínicas
        $clinicalHistories = ClinicalHistory::all();
        return response()->json($clinicalHistories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Esto es para devolver una vista de creación (opcional en APIs)
        return view('clinical_histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Crear una nueva historia clínica
        $clinicalHistory = ClinicalHistory::create($validatedData);

        return response()->json($clinicalHistory, 201); // 201: Recurso creado
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener una historia clínica por su ID
        $clinicalHistory = ClinicalHistory::findOrFail($id);
        return response()->json($clinicalHistory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Devolver una vista de edición (opcional en APIs)
        $clinicalHistory = ClinicalHistory::findOrFail($id);
        return view('clinical_histories.edit', compact('clinicalHistory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Actualizar la historia clínica
        $clinicalHistory = ClinicalHistory::findOrFail($id);
        $clinicalHistory->update($validatedData);

        return response()->json($clinicalHistory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar una historia clínica
        $clinicalHistory = ClinicalHistory::findOrFail($id);
        $clinicalHistory->delete();

        return response()->json(['message' => 'Historia clínica eliminada correctamente']);
    }
}
