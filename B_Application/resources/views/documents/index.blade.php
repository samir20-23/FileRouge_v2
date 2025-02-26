@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Documents</h2>
        <a href="{{ route('documents.create') }}" class="btn btn-primary">Add Document</a>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td>{{ $document->title }}</td>
                    <td>{{ $document->type }}</td>
                    <td>{{ $document->categorie->name }}</td>
                    <td class="d-flex justify-content-start">
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
