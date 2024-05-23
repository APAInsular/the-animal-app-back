<?php

namespace App\Http\Controllers;

use App\Models\Padrino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// made by Harkaitz

class PadrinoController extends Controller
{
    /**
     * Display a listing of the padrinos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $padrinos = Padrino::with('user')->get();
        return response()->json($padrinos);
    }

    /**
     * Store a newly created padrino in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:padrinos',
            'telefono' => 'required|string|max:20',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $padrino = Padrino::create($request->all());
        return response()->json($padrino, 201);
    }

    /**
     * Display the specified padrino.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $padrino = Padrino::with('user')->find($id);
        if (!$padrino) {
            return response()->json(['error' => 'Padrino not found'], 404);
        }

        return response()->json($padrino);
    }

    /**
     * Update the specified padrino in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:padrinos,email,' . $id,
            'telefono' => 'sometimes|string|max:20',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $padrino = Padrino::find($id);
        if (!$padrino) {
            return response()->json(['error' => 'Padrino not found'], 404);
        }

        $padrino->update($request->all());
        return response()->json($padrino);
    }

    /**
     * Remove the specified padrino from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $padrino = Padrino::find($id);
        if (!$padrino) {
            return response()->json(['error' => 'Padrino not found'], 404);
        }

        $padrino->delete();
        return response()->json(['message' => 'Padrino deleted successfully']);
    }
}
