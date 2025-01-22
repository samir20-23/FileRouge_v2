<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();  // Retrieve all categories
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Categorie::findOrFail($id);  // Find the category by ID
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Categorie::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
