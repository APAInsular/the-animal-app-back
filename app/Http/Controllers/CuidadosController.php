<?php

namespace App\Http\Controllers;

use App\Models\Cuidados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuidadosController extends Controller
{
    /**
     * Display a listing of the cuidados.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cuidados = Cuidados::with('animal')->get();
        return response()->json($cuidados);
    }

    /**
     * Store a newly created cuidado in storage.
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

        $cuidado = Cuidados::create($request->all());
        return response()->json($cuidado, 201);
    }

    /**
     * Display the specified cuidado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $cuidado = Cuidados::with('animal')->find($id);
        if (!$cuidado) {
            return response()->json(['error' => 'Cuidado not found'], 404);
        }

        return response()->json($cuidado);
    }

    /**
     * Update the specified cuidado in storage.
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
            'animal_id' => 'sometimes|exists:animals,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $cuidado = Cuidados::find($id);
        if (!$cuidado) {
            return response()->json(['error' => 'Cuidado not found'], 404);
        }

        $cuidado->update($request->all());
        return response()->json($cuidado);
    }

    /**
     * Remove the specified cuidado from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $cuidado = Cuidados::find($id);
        if (!$cuidado) {
            return response()->json(['error' => 'Cuidado not found'], 404);
        }

        $cuidado->delete();
        return response()->json(['message' => 'Cuidado deleted successfully']);
    }
}
