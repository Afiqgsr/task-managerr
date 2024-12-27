<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
        ->orderBy('due_date')
        ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $tasks
        ]);
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            ...$request->validated()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Task berhasil dibuat',
            'data' => $task
        ], 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json([
            'status' => 'success',
            'data' => $task
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Task berhasil diperbarui',
            'data' => $task
        ]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task berhasil dihapus'
        ]);
    }
}