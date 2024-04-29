<?php

namespace App\Http\Controllers;

use App\Models\Formacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormacionController extends Controller
{
    /**
     * Display a listing of the formaciones.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $formaciones = Formacion::with('voluntarios')->get();
        return response()->json($formaciones);
    }

    /**
     * Store a newly created formacion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $formacion = Formacion::create($request->all());
        return response()->json($formacion, 201);
    }

    /**
     * Display the specified formacion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $formacion = Formacion::with('voluntarios')->find($id);
        if (!$formacion) {
            return response()->json(['error' => 'Formacion not found'], 404);
        }

        return response()->json($formacion);
    }

    /**
     * Update the specified formacion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date|after_or_equal:fecha_inicio'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $formacion = Formacion::find($id);
        if (!$formacion) {
            return response()->json(['error' => 'Formacion not found'], 404);
        }

        $formacion->update($request->all());
        return response()->json($formacion);
    }

    /**
     * Remove the specified formacion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $formacion = Formacion::find($id);
        if (!$formacion) {
            return response()->json(['error' => 'Formacion not found'], 404);
        }

        $formacion->delete();
        return response()->json(['message' => 'Formacion deleted successfully']);
    }
}
