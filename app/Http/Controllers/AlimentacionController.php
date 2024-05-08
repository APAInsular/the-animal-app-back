<?php

namespace App\Http\Controllers;

use App\Models\Alimentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlimentacionController extends Controller
{
    /**
     * Display a listing of the alimentacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alimentaciones = Alimentacion::with('animal')->get();
        return response()->json($alimentaciones);
    }

    /**
     * Store a newly created alimentacion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $alimentacion = Alimentacion::create($request->all());
        return response()->json($alimentacion, 201);
    }

    /**
     * Display the specified alimentacion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alimentacion = Alimentacion::with('animal')->find($id);
        if (!$alimentacion) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($alimentacion);
    }

    /**
     * Update the specified alimentacion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'sometimes|string|max:255',
            'cantidad' => 'sometimes|numeric',
            'animal_id' => 'sometimes|exists:animals,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $alimentacion = Alimentacion::find($id);
        if (!$alimentacion) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $alimentacion->update($request->all());
        return response()->json($alimentacion);
    }

    /**
     * Remove the specified alimentacion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alimentacion = Alimentacion::find($id);
        if (!$alimentacion) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $alimentacion->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
