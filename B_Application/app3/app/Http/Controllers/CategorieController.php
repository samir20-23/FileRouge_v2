<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    protected $categories;

    public function __construct(CategorieService $categories)
    {
        $this->middleware('auth');
        $this->categories = $categories;
    }

    public function index()
    {
        $cats = $this->categories->getAll();
        return view('categories.index', compact('cats'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $this->categories->create($data);
        return redirect()->route('categories.index');
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $categorie->update($data);
        return redirect()->route('categories.index');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categories.index');
    }
}
