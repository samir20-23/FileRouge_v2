@extends('layouts.admin')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white text-center">
          <h5>Ajouter un Article</h5>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('articles.store') }}">
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
                value="{{ old('title') }}"
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
                <option value="" hidden>-- Choisir une catégorie --</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">
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
                  <option value="{{ $tag->id }}">
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
                class="form-control summernote"
                id="summernote"
                rows="5"
                placeholder="Contenu de l'article"
                required>{{ old('content') }}</textarea>
            </div>

            {{-- Boutons d'action --}}
            <div class="text-center">
              <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour</a>
              <button type="submit" class="btn btn-success px-4">Ajouter</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
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