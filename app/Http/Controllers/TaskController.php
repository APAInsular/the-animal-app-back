<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['zone', 'animal', 'user'])->get();
        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = Task::with(['zone', 'animal', 'user'])->findOrFail($id);
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:45',
            'Description' => 'nullable|string',
            'idZone' => 'required|exists:zones,idZone',
            'idAnimal' => 'required|exists:animals,idAnimal',
            'idUser' => 'required|exists:users,idUser'
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:45',
            'Description' => 'sometimes|string',
            'idZone' => 'sometimes|exists:zones,idZone',
            'idAnimal' => 'sometimes|exists:animals,idAnimal',
            'idUser' => 'sometimes|exists:users,idUser'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
