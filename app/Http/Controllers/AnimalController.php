<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// made by Harkaitz , modified by Lucas

class AnimalController extends Controller
{
    /**
     * Display a listing of animals.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::with(['tarea', 'historialesMedicos','vacunaciones'])->get();
        return response()->json($animals);
    }

    /**
     * Show the form for creating a new animal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view or a form to create a new animal
    }

    /**
     * Store a newly created animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            // 'edad' => 'required|integer',
            // 'historia' => 'required|string',
            // 'especie_id' => 'required|exists:especies,id',
            'alimentacion_id' => 'exists:alimentacions,id',
            'cuidados_id' => 'exists:cuidados,id',
            'necesidades_id' => 'exists:necesidades,id',
            'tarea_id' => 'exists:tareas,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $animal = Animal::create($request->all());

        if ($request->has('historiales_medicos')) {
            foreach ($request->historiales_medicos as $historial) {
                $animal->historialesMedicos()->create($historial);
            }
        }

        if ($request->has('vacunaciones')) {
            foreach ($request->vacunaciones as $vacunacionData) {
                $animal->vacunaciones()->create($vacunacionData);
            }
        }

        return response()->json($animal, 201);
    }

    /**
     * Display the specified animal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::with(['especie', 'alimentacion', 'cuidados', 'necesidades', 'tarea', 'historialesMedicos','vacunaciones'])->findOrFail($id);
        return response()->json($animal);
    }

    /**
     * Show the form for editing the specified animal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Return a view or a form to edit an existing animal
    }

    /**
     * Update the specified animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            // 'edad' => 'sometimes|integer',
            // 'historia' => 'sometimes|string',
            // 'especie_id' => 'exists:especies,id',
            'alimentacion_id' => 'exists:alimentacions,id',
            'cuidados_id' => 'exists:cuidados,id',
            'necesidades_id' => 'exists:necesidades,id',
            'tarea_id' => 'exists:tareas,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        if ($request->has('historiales_medicos')) {
            // Borrar historiales existentes
            $animal->historialesMedicos()->delete();

            // Crear nuevos historiales
            foreach ($request->historiales_medicos as $historial) {
                $animal->historialesMedicos()->create($historial);
            }
        }
        if ($request->has('vacunaciones')) {
            // Borrar vacunas existentes
            $animal->vacunaciones()->delete();

            // Crear nuevas vacunas
            foreach ($request->vacunaciones as $vacunacionData) {
                $animal->vacunaciones()->create($vacunacionData);
            }
        }


        return response()->json($animal);
    }

    /**
     * Remove the specified animal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return response()->json(['message' => 'Animal deleted successfully'], 200);
    }
}
