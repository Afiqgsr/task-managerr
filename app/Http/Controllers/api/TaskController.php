<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $this->authorize('view Task');
        $Task = Task::paginate(10);
        return response()->json($Task);
    }

    public function store(Request $request)
    {
        $this->authorize('create Task');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $product = Task::create($validated);
        return response()->json($product, 201);
    }

    public function show(Task $product)
    {
        $this->authorize('view Task');
        return response()->json($product);
    }

    public function update(Request $request, Task $product)
    {
        $this->authorize('edit Task');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Task $product)
    {
        $this->authorize('delete Task');
        $product->delete();
        return response()->json(null, 204);
    }
}