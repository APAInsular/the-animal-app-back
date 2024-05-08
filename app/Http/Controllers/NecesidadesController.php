<?php

namespace App\Http\Controllers;

use App\Models\Necesidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NecesidadesController extends Controller
{
    /**
     * Display a listing of the necesidades.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $necesidades = Necesidades::with('animal')->get();
        return response()->json($necesidades);
    }

    /**
     * Store a newly created necesidad in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'animal_id' => 'required|exists:animals,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $necesidad = Necesidades::create($request->all());
        return response()->json($necesidad, 201);
    }

    /**
     * Display the specified necesidad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $necesidad = Necesidades::with('animal')->find($id);
        if (!$necesidad) {
            return response()->json(['error' => 'Necesidad not found'], 404);
        }

        return response()->json($necesidad);
    }

    /**
     * Update the specified necesidad in storage.
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
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $necesidad = Necesidades::find($id);
        if (!$necesidad) {
            return response()->json(['error' => 'Necesidad not found'], 404);
        }

        $necesidad->update($request->all());
        return response()->json($necesidad);
    }

    /**
     * Remove the specified necesidad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $necesidad = Necesidades::find($id);
        if (!$necesidad) {
            return response()->json(['error' => 'Necesidad not found'], 404);
        }

        $necesidad->delete();
        return response()->json(['message' => 'Necesidad deleted successfully']);
    }
}
