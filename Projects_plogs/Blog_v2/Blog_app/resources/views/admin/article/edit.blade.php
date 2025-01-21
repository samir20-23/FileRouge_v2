@extends('layouts.admin')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white text-center">
          <h5>Modifier un Article</h5>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('articles.update', $article->id) }}">
            @method('PUT')
            @csrf

            {{-- Titre --}}
            <div class="mb-3">
              <label for="title" class="form-label">Titre</label>
              <input
                type="text"
                name="title"
                class="form-control"
                id="title"
                placeholder="Titre de l'article"
                value="{{ old('title', $article->title) }}"
                required>
            </div>

            {{-- Catégorie --}}
            <div class="mb-3">
              <label for="category" class="form-label">Catégorie</label>
              <select
                name="category"
                class="form-select"
                id="category"
                required>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}"
                    {{ $article->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Tags (Multi-Select Dropdown) --}}
            <div class="mb-3">
              <label for="tags" class="form-label">Tags</label>
              <select
                name="tags[]"
                id="tags"
                class="form-select"
                multiple>
                @foreach($allTags as $tag)
                  <option value="{{ $tag->id }}"
                    {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                    {{ $tag->name }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Contenu --}}
            <div class="mb-3">
              <label for="content" class="form-label">Contenu</label>
              <textarea
                name="content"
                class="form-control"
                id="summernote"
                rows="5"
                placeholder="Contenu de l'article"
                required>{{ old('content', $article->content) }}</textarea>
            </div>

            {{-- Boutons d'action --}}
            <div class="mt-5 d-flex justify-content-between">
              <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour aux articles</a>
              <button type="submit" class="btn btn-primary px-4">Modifier</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Rédigé votre article ici...',
      tabsize: 2,
      height: 200
    });
  });
</script>
@endsection
