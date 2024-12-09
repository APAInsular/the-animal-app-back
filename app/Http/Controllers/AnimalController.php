<?php

namespace App\Http\Controllers;

use App\Models\Animal;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los animales
        $animals = Animal::all();
        return response()->json($animals);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Devolver una vista para la creación de un animal (opcional para APIs)
        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'species_id' => 'required|exists:species,id', // Asegurar que la especie exista
            'race_id' => 'required|exists:races,id', // Asegurar que la raza exista
            'microchip' => 'nullable|string|unique:animals,microchip',
        ]);

        // Crear un nuevo animal
        $animal = Animal::create($validatedData);

        return response()->json($animal, 201); // 201: Recurso creado
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener un animal por su ID
        $animal = Animal::findOrFail($id);
        return response()->json($animal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Devolver una vista para la edición de un animal (opcional para APIs)
        $animal = Animal::findOrFail($id);
        return view('animals.edit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'species_id' => 'required|exists:species,id',
            'race_id' => 'required|exists:races,id',
            'microchip' => 'nullable|string|unique:animals,microchip,' . $id, // Permitir que el microchip sea único excepto para este animal
        ]);

        // Actualizar el animal
        $animal = Animal::findOrFail($id);
        $animal->update($validatedData);

        return response()->json($animal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar un animal
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->json(['message' => 'Animal eliminado correctamente']);
    }
}
