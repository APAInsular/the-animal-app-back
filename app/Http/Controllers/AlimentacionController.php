<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    /**
     * Display a listing of the animals.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $animals = Animal::with(['especie', 'alimentacion', 'cuidados', 'necesidades', 'tarea', 'necesidadesCuidadosTareas'])->get();
        return response()->json($animals);
    }

    /**
     * Store a newly created animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer',
            'historia' => 'required|string',
            'especie_id' => 'required|exists:especies,id',
            'alimentacion_id' => 'required|exists:alimentacions,id',
            'cuidados_id' => 'required|exists:cuidados,id',
            'necesidades_id' => 'required|exists:necesidades,id',
            'tarea_id' => 'required|exists:tareas,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $animal = Animal::create($request->all());
        return response()->json($animal, 201);
    }

    /**
     * Display the specified animal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $animal = Animal::with(['especie', 'alimentacion', 'cuidados', 'necesidades', 'tarea', 'necesidadesCuidadosTareas'])->find($id);
        if (!$animal) {
            return response()->json(['error' => 'Animal not found'], 404);
        }

        return response()->json($animal);
    }

    /**
     * Update the specified animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'edad' => 'sometimes|integer',
            'historia' => 'sometimes|string',
            'especie_id' => 'sometimes|exists:especies,id',
            'alimentacion_id' => 'sometimes|exists:alimentacions,id',
            'cuidados_id' => 'sometimes|exists:cuidados,id',
            'necesidades_id' => 'sometimes|exists:necesidades,id',
            'tarea_id' => 'sometimes|exists:tareas,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $animal = Animal::find($id);
        if (!$animal) {
            return response()->json(['error' => 'Animal not found'], 404);
        }

        $animal->update($request->all());
        return response()->json($animal);
    }

    /**
     * Remove the specified animal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        if (!$animal) {
            return response()->json(['error' => 'Animal not found'], 404);
        }

        $animal->delete();
        return response()->json(['message' => 'Animal deleted successfully']);
    }
}
