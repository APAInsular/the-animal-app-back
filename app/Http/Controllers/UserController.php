<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'animals', 'tasks'])->get();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::with(['roles', 'animals', 'tasks'])->findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'FirstName' => 'required|string|max:45',
            'LastName' => 'required|string|max:45',
            'Email' => 'required|string|max:45|email|unique:users,Email'
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'FirstName' => 'sometimes|string|max:45',
            'LastName' => 'sometimes|string|max:45',
            'Email' => 'sometimes|email|max:45|unique:users,Email,' . $id . ',idUser'
        ]);

        $user->update($validated);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
