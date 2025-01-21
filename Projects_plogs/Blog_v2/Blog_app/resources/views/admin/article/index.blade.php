@extends('layouts.admin')

@section('content')
    <div class="container">

    <h1>Gestion des Articles</h1>
  

    <x-admin-chart 
    :ArticleCount="$ArticleCount"
    :UserCount="$UserCount" 
    :CommentCount="$CommentCount" > </x-admin-chart>

    <div class="card">
        <div class="card-header d-flex pb-0 pt-3">
                <!-- input search --> 
                <form method="GET" action="{{ route('articles.index') }}" class="d-flex mb-3 ">
                    <div class="form-group  ">
                        <input type="text" name="search" id="search" class="form-control " value="{{ request('search') }}" placeholder="Rechercher un article">
                    </div>
                    <div class="form-group  ">
                    <button type="submit" class="btn btn-primary mx-3">Rechercher</button>
                    </div>
                </form>

                <!-- select category and tag -->
                <form method="GET" action="{{ route('articles.index') }}" class="d-flex mb-3 mx-3">
                    <div class="form-group mr-2 mx-2">
                        <select name="category" id="category" class="form-control">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <select name="tag" id="tag" class="form-control mx-2">
                            <option value="">Tous les tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mx-3">Filtrer</button>
                </form>

        </div>
        <!-- /.card-header -->
         <div class="d-flex justify-content-between mx-3 mt-3">
             <h3 class="card-title my-0">Liste des Articles</h3>
             
            <a href="{{route('articles.create')}}" class="btn btn-success">Ajouter un Article</a>  
         </div>
        
            <div class="card-body">
                @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
                 @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date de Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- logic pour recherch -->
                     
                    @foreach($articles as $article)
                        @if(
                            (empty(request('category')) || $article->category->id == request('category')) &&
 
                            ($article->tags->pluck('id')->contains(request('tag')) || !request('tag')) &&

                            (strpos($article->title, request('search')) !== false || strpos($article->content, request('search')) !== false || !request('search'))
                    )
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-secondary">Afficher</a>
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            <!-- pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $articles->links() }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
@stop
