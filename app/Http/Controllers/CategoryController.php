<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    public function hapus(Category $task)
    {
         $task->forceDelete();

    return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus secara permanen.');
    }
   
}
