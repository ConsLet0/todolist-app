<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\todos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = categories::with('todos')->where('users_id', auth()->id())->get();
        return view('home', compact('categories'));
    }

    public function storeCategories(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $category = new categories();
        $category->users_id = $user->id;
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('home')->with('success', 'Category sudah ditambahkan !');
    }

    public function editCategories($id)
    {
        $category = categories::findOrFail($id);
        return redirect()->route('home', compact("category"));
    }

    public function updateCategories(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = categories::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('home')->with('warning', 'Kategori berhasil diperbarui!');
    }

    public function deleteCategories($id)
    {
        $category = categories::findOrFail($id);
        $category->delete();

        return redirect()->route('home')->with('danger', 'Category sudah dihapus !');
    }

    public function storeTodos(Request $request)
    {
        $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'due_date' => 'required|date_format:H:i',
        ]);

        $todo = new todos();
        $todo->categories_id = $request->categories_id;
        $todo->title = $request->title;
        $todo->due_date = $request->due_date;
        $todo->is_finished = $request->has('is_finished') ? 1 : 0;

        $todo->save();
        return redirect()->route('home')->with('success', 'Task sudah ditambahkan!');
    }

    public function updateTodos(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date_format:H:i',
        ]);

        $todo = todos::findOrFail($id);
        $todo->title = $request->input('title');
        $todo->due_date = $request->input('due_date');
        $todo->save();

        return response()->json(['success' => true]);
    }

    public function deleteTodo($id)
    {
        $todo = todos::findOrFail($id);
        $todo->delete();

        return redirect()->route('home')->with('danger', 'Task berhasil dihapus!');
    }
}
