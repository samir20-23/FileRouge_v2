@extends('layout.app')

@section('content')
    <h1>Dashboard</h1>

    <div class="stats">
        <p>Total Documents: {{ $documentsCount }}</p>
        <p>Total Categories: {{ $categoriesCount }}</p>
    </div>

    <div class="buttons">
        <a href="{{ route('documents.index') }}" class="btn btn-primary">View Documents</a>
        <a href="{{ route('documents.create') }}" class="btn btn-success">Create Document</a>
    </div>
@endsection
<!-- dashboard.blade.php -->
