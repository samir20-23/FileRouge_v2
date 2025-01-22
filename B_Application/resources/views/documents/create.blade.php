@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="PDF">PDF</option>
                <option value="Video">Video</option>
            </select>
        </div>
        <div class="form-group">
            <label for="chemin_fichier">File</label>
            <input type="file" name="chemin_fichier" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="categorie_id">Category</label>
            <select name="categorie_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
