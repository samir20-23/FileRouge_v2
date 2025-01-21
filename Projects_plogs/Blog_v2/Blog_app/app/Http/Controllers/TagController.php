<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class TagController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = Tag::query();
    if($request->has('search') && $request->search != ''){
      $query->where('name', 'like', '%' . $request->search . '%');
    }

    $tags = $query->paginate(10);
    return view('admin.tag.index', compact('tags'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.tag.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $tag = new Tag();
    $tag->name = $request->name;
    $tag->save();

    return redirect()->route('tags.index')->with('success', 'Le tag a bien été créé');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {

    $tag = Tag::findOrFail($id);
    $tag->delete();

    return redirect()->route('tags.index')->with('success', 'Le tag a bien été supprimé');
  }
}
