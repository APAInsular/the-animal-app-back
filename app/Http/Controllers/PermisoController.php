<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// made by Harkaitz

class PermisoController extends Controller
{
    /**
     * Display a listing of the permisos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $permisos = Permiso::with('rols')->get();
        return response()->json($permisos);
    }

    /**
     * Store a newly created permiso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $permiso = Permiso::create($request->all());
        return response()->json($permiso, 201);
    }

    /**
     * Display the specified permiso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $permiso = Permiso::with('rols')->find($id);
        if (!$permiso) {
            return response()->json(['error' => 'Permiso not found'], 404);
        }

        return response()->json($permiso);
    }

    /**
     * Update the specified permiso in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'sometimes|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $permiso = Permiso::find($id);
        if (!$permiso) {
            return response()->json(['error' => 'Permiso not found'], 404);
        }

        $permiso->update($request->all());
        return response()->json($permiso);
    }

    /**
     * Remove the specified permiso from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        if (!$permiso) {
            return response()->json(['error' => 'Permiso not found'], 404);
        }

        $permiso->delete();
        return response()->json(['message' => 'Permiso deleted successfully']);
    }
}
