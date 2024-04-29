<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspecieController extends Controller
{
    /**
     * Display a listing of the especies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $especies = Especie::with('animals')->get();
        return response()->json($especies);
    }

    /**
     * Store a newly created especie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $especie = Especie::create($request->all());
        return response()->json($especie, 201);
    }

    /**
     * Display the specified especie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $especie = Especie::with('animals')->find($id);
        if (!$especie) {
            return response()->json(['error' => 'Especie not found'], 404);
        }

        return response()->json($especie);
    }

    /**
     * Update the specified especie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $especie = Especie::find($id);
        if (!$especie) {
            return response()->json(['error' => 'Especie not found'], 404);
        }

        $especie->update($request->only('nombre'));
        return response()->json($especie);
    }

    /**
     * Remove the specified especie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $especie = Especie::find($id);
        if (!$especie) {
            return response()->json(['error' => 'Especie not found'], 404);
        }

        $especie->delete();
        return response()->json(['message' => 'Especie deleted successfully']);
    }
}
