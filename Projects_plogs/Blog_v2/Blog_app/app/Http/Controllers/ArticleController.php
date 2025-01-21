<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\User;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
 
  public function index(Request $request)
  {
    $query = Article::query();
    
    $ArticleCount= Article::count();
    $CommentCount = Comment::count();
    $UserCount = User::count();

    // Filtrer par catégorie
    if ($request->has('category') && $request->category != '') {
      $query->where('category_id', $request->category);
    }

    // Filtrer par tag
    if ($request->has('tag') && $request->tag != '') {
      $query->whereHas('tags', function ($query) use ($request) {
        $query->where('tags.id', $request->tag);
      });
    }

    // Filtrer par recherche dans le titre ou le contenu
    if ($request->has('search') && $request->search != '') {
      $query->where(function ($query) use ($request) {
        $query->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('content', 'like', '%' . $request->search . '%');
      });
    }

    // Paginer les résultats
    $articles = $query->paginate(10);

    // Ajouter les paramètres de filtrage à la pagination
    $articles->appends($request->all());
    $categories = \App\Models\Category::all();
    $tags = \App\Models\Tag::all();


    if (Auth::check() && Auth::user()->roles->contains('name', 'admin')) {
      return view('admin.article.index', compact('articles', 'categories', 'tags','ArticleCount','CommentCount', 'UserCount' ));
    } else {
      return view('public.index', compact('articles', 'categories', 'tags'));
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
      return redirect()->route('articles.index');
    }

    $categories = Category::all();
    $allTags = Tag::all();

    return view('admin.article.create', compact('categories', 'allTags'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
      return redirect()->route('articles.index');
    }

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'category' => 'required|exists:categories,id',
      'content' => 'required|string',
      'tags' => 'array',
      'tags.*' => 'exists:tags,id',
    ]);

    $article = Article::create([
      'title' => $validated['title'],
      'category_id' => $validated['category'],
      'content' => $validated['content'],
    ]);

    // Attach selected tags
    $article->tags()->attach($validated['tags'] ?? []);

    return redirect()->route('articles.index')->with('success', 'L\'article a bien été créé');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $article = Article::with(['category', 'tags', 'comments'])->findOrFail($id);
    $commentableId = $article->id;
    $commentableType = Article::class;

    if (Auth::check() && Auth::user()->roles->contains('name', 'admin')) {
      return view('admin.article.show', compact('article', 'commentableId', 'commentableType'));
    } else {
      return view('public.show', compact('article', 'commentableId', 'commentableType'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
      return redirect()->route('articles.index');
    }

    $article = Article::findOrFail($id);
    $categories = Category::all();
    $allTags = Tag::all();
    $selectedTags = $article->tags->pluck('id')->toArray();

    return view('admin.article.edit', compact('article', 'categories', 'allTags', 'selectedTags'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
      return redirect()->route('articles.index');
    }

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'category' => 'required|exists:categories,id',
      'content' => 'required|string',
      'tags' => 'array',
      'tags.*' => 'exists:tags,id',
    ]);

    $article = Article::findOrFail($id);
    $article->update([
      'title' => $validated['title'],
      'category_id' => $validated['category'],
      'content' => $validated['content'],
    ]);

    $article->tags()->sync($validated['tags'] ?? []);

    return redirect()->route('articles.index')->with('success', 'L\'article a bien été modifié');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
      return redirect()->route('articles.index');
    }

    $article = Article::where('id', $id);
    $article->delete();
    return redirect()->route('articles.index')->with('success', 'L\'article a bien été supprimé');
  }
}
