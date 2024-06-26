<?php

namespace App\Http\Controllers;

use App\Models\Voluntario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// made by Harkaitz , modified by Ivan

class VoluntarioController extends Controller
{
    /**
     * Display a listing of the voluntarios.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $voluntarios = Voluntario::all();
        return response()->json($voluntarios);
    }

    /**
     * Store a newly created voluntario in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:voluntarios',
            'disponibilidad' => 'required|date',
            'idioma' => 'required|string|max:255',
            'horario' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'formacion_id' => 'required|exists:formacions,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $request['contraseña'] = bcrypt($request['contraseña']); // Encrypt password before saving
        $voluntario = Voluntario::create($request->all());
        return response()->json($voluntario, 201);
    }

    /**
     * Display the specified voluntario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($voluntarios)
    {

        return response()->json($voluntarios);
    }

    /**
     * Update the specified voluntario in storage.
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
            'email' => 'sometimes|string|email|max:255|unique:voluntarios,email,' . $id,
            'disponibilidad' => 'sometimes|date',
            'idioma' => 'sometimes|string|max:255',
            'horario' => 'sometimes|string|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'formacion_id' => 'sometimes|exists:formacions,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $voluntario = Voluntario::find($id);
        if (!$voluntario) {
            return response()->json(['error' => 'Voluntario not found'], 404);
        }

        if ($request->has('contraseña')) {
            $request['contraseña'] = bcrypt($request['contraseña']);
        }
        $voluntario->update($request->all());
        return response()->json($voluntario);
    }

    /**
     * Remove the specified voluntario from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $voluntario = Voluntario::find($id);
        if (!$voluntario) {
            return response()->json(['error' => 'Voluntario not found'], 404);
        }

        $voluntario->delete();
        return response()->json(['message' => 'Voluntario deleted successfully']);
    }


    public function tareas($voluntarioId)
    {
        $voluntario = Voluntario::with('tareas')->findOrFail($voluntarioId);
        return response()->json($voluntario->tareas);
    }
}
