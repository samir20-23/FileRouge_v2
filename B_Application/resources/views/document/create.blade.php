@extends('layout.app')

@section('content')
    <h1>Create Document</h1>

    <form action="{{ route('documents.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="type">Type</label>
        <input type="text" name="type" id="type" required>

        <label for="file">File</label>
        <input type="file" name="chemin_fichier" id="file" required>

        <button type="submit">Save</button>
    </form>
@endsection
