<?php

namespace App\Http\Controllers;

use App\Models\DireccionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// made by Harkaitz

class DireccionController extends Controller
{
    /**
     * Display a listing of the direcciones.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $direcciones = DireccionUsuario::with('user')->get();
        return response()->json($direcciones);
    }

    /**
     * Store a newly created direccion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'ciudad' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $direccion = DireccionUsuario::create($request->all());
        return response()->json($direccion, 201);
    }

    /**
     * Display the specified direccion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $direccion = DireccionUsuario::with('user')->find($id);
        if (!$direccion) {
            return response()->json(['error' => 'Direccion not found'], 404);
        }

        return response()->json($direccion);
    }

    /**
     * Update the specified direccion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'calle' => 'sometimes|string|max:255',
            'numero' => 'sometimes|string|max:10',
            'ciudad' => 'sometimes|string|max:255',
            'localidad' => 'sometimes|string|max:255',
            'codigo_postal' => 'sometimes|string|max:10',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $direccion = DireccionUsuario::find($id);
        if (!$direccion) {
            return response()->json(['error' => 'Direccion not found'], 404);
        }

        $direccion->update($request->all());
        return response()->json($direccion);
    }

    /**
     * Remove the specified direccion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $direccion = DireccionUsuario::find($id);
        if (!$direccion) {
            return response()->json(['error' => 'Direccion not found'], 404);
        }

        $direccion->delete();
        return response()->json(['message' => 'Direccion deleted successfully']);
    }
}
