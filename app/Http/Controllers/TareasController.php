<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareasController extends Controller
{
    /**
     * Display a listing of the tareas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tareas = Tareas::with(['animal', 'voluntario'])->get();
        return response()->json($tareas);
    }

    /**
     * Store a newly created tarea in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'SeRepite' => 'required|boolean',
            'fecha' => 'required|date',
            'comentario' => 'string|nullable',
            'url' => 'string|nullable',
            'animal_id' => 'required|exists:animals,id',
            'voluntario_id' => 'required|exists:voluntarios,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tarea = Tareas::create($request->all());
        return response()->json($tarea, 201);
    }

    /**
     * Display the specified tarea.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tarea = Tareas::with(['animal', 'voluntario'])->find($id);
        if (!$tarea) {
            return response()->json(['error' => 'Tarea not found'], 404);
        }

        return response()->json($tarea);
    }

    /**
     * Update the specified tarea in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'SeRepite' => 'sometimes|boolean',
            'finalizado' => 'sometimes|boolean',
            'fecha' => 'sometimes|date',
            'comentario' => 'nullable|string',
            'animal_id' => 'sometimes|exists:animals,id',
            'voluntario_id' => 'sometimes|exists:voluntarios,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tarea = Tareas::find($id);
        if (!$tarea) {
            return response()->json(['error' => 'Tarea not found'], 404);
        }

        $tarea->update($request->all());
        return response()->json($tarea);
    }

    /**
     * Remove the specified tarea from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tarea = Tareas::find($id);
        if (!$tarea) {
            return response()->json(['error' => 'Tarea not found'], 404);
        }

        $tarea->delete();
        return response()->json(['message' => 'Tarea deleted successfully']);
    }
}
