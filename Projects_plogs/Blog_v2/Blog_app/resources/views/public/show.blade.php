@extends('layouts.public')
@section('content')
<div class="container mx-auto my-10 px-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="text-5xl font-extrabold text-gray-900">Détails de l'article</h1>
        <p class="text-lg text-gray-600 mt-2">Explorez les détails de l’article sélectionné.</p>
    </div>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif
    <!-- Article Card -->
    <div class="bg-white shadow-xl rounded-xl p-8 mt-8 border border-gray-200">
        <!-- Article Title -->
        <h2 class="text-3xl font-semibold text-gray-800">{{ $article->title }}</h2>

        <!-- Author and Date -->
        <div class="mt-4 text-sm text-gray-500">
            <p>Publié le <span class="font-medium text-gray-600">{{ $article->created_at->format('F j, Y') }}</span></p>
        </div>

        <!-- categories -->
        <div class="mt-4 text-sm text-gray-500">
            <p>Catégorie:
                @if($article->category)
                <span class="font-medium text-gray-600">                  
                    {{ $article->category->name }}
                </span>
                @else
                <span class="font-medium text-gray-600">No category available</span>
                @endif
            </p>
        </div>

        <!-- tags -->
        <div class="mt-4 text-sm text-gray-500">
            <p>Tags:
                @if($article->tags)
                <span class="font-medium text-gray-600">
                    @foreach($article->tags as $tag)
                    {{ $tag->name }}@if(!$loop->last), @endif
                    @endforeach
                </span>
                @else
                <span class="font-medium text-gray-600">No tags available</span>
                @endif
            </p>
        </div>

        <!-- Article Content -->
        <div class="mt-6 text-gray-700 leading-relaxed space-y-4">
            {{ $article->content }}
        </div>

        <!-- Buttons -->
        <div class="mt-8 flex justify-between space-x-6">
            <form action="/articles" method="GET" class="inline">
                <button type="submit" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                    Retour aux articles
                </button>
            </form>
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="w-full max-w-lg">
        <div class="bg-gray-100 shadow rounded-lg">
            <div class="p-6">
                <!-- Add Comment -->
                <div class="mb-4">
                    <h2 class="text-3xl font-semibold text-gray-800 text-center">Commentaires</h2>

                    @if(Auth::check())
                    <form action="{{ route('comments.store') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{ $commentableId }}">
                        <input type="hidden" name="commentable_type" value="{{ $commentableType }}">
                        <input type="text" name="text" id="addComment" class="flex w-full space-x-2 my-2 form-control border p-2 rounded" placeholder="Tapez un commentaire..." required>
                        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded"> Ajouter </button>
                    </form>
                    @endif
                </div>

                <!-- Display Comments -->
                @foreach($article->comments as $comment)
                <div class="bg-white rounded-lg shadow mb-4">
                    <div class="p-4">
                        <p class="text-gray-700">{{$comment->text}}</p>
                        <div class="flex justify-between items-center mt-2">
                            <div class="flex items-center">
                                <p class="text-sm text-gray-500">comment author</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Repeat comment structure for more comments -->
            </div>
        </div>
    </div>
</div>

@endsection