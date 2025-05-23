@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Documents</h2>
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Create New Document</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
            <tr>
                <td>{{ $document->id }}</td>
                <td>{{ $document->title }}</td>
                <td><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View</a></td>
                <td>
                    <a href="{{ route('documents.edit', $document) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('documents.destroy', $document) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this document?')">Delete</button>
                    </form>
                    <a href="{{ route('documents.show', $document) }}" class="btn btn-info btn-sm">Show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
