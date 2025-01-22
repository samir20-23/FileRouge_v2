@extends('layouts.app')

@section('content')
<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" required>{{ $category->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
