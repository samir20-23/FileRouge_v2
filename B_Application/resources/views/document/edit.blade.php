@extends('layout.app')

@section('content')
    <h1>Edit Document</h1>

    <form action="{{ route('documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $document->title }}" required>

        <label for="type">Type</label>
        <input type="text" name="type" id="type" value="{{ $document->type }}" required>

        <label for="file">File</label>
        <input type="file" name="chemin_fichier" id="file">

        <button type="submit">Update</button>
    </form>
@endsection
