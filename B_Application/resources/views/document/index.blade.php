@extends('layout.app')

@section('content')
    <h1>Documents</h1>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->title }}</td>
                    <td>{{ $document->type }}</td>
                    <td>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('documents.create') }}" class="btn btn-success">Create Document</a>
@endsection
