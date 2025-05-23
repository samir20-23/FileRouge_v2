@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Document</h2>
    <form method="POST" action="{{ route('documents.update', $document) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input name="title" class="form-control" value="{{ $document->title }}" required>
        </div>
        <div class="mb-3">
            <label>File (upload to replace)</label>
            <input type="file" name="file_path" class="form-control">
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="categorie_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $document->categorie_id ? 'selected' : '' }}>{{ $category->label }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
