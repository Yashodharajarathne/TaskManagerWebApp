<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        return Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);
        return response()->json(['message' => 'Task created successfully'], 201);
    }

    public function toggle($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed;
        $task->save();
        return $task;
    }

    public function destroy($id)
    {
        $task::destroy($id);
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

}
