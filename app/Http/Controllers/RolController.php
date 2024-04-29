<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Rol::with(['permiso', 'users'])->get();
        return response()->json($roles);
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'permiso_id' => 'required|exists:permisos,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $rol = Rol::create($request->all());
        return response()->json($rol, 201);
    }

    /**
     * Display the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rol = Rol::with(['permiso', 'users'])->find($id);
        if (!$rol) {
            return response()->json(['error' => 'Rol not found'], 404);
        }

        return response()->json($rol);
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'permiso_id' => 'sometimes|exists:permisos,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['error' => 'Rol not found'], 404);
        }

        $rol->update($request->all());
        return response()->json($rol);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['error' => 'Rol not found'], 404);
        }

        $rol->delete();
        return response()->json(['message' => 'Rol deleted successfully']);
    }
}
