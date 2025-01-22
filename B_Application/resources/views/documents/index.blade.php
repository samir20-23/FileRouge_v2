@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Add Document</a>
    <table class="table">
        @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                <td>
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
