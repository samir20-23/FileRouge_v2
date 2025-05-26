@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Categorie</a>
        <table class="table">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <thead>
                <tr>
                    <th>name</th>
                    <th>description</th>
                    <th>created at</th>
                    <th>updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->name }}</td>
                        <td>{{ $categorie->description }}</td>
                        <td>{{ $categorie->created_at }}</td>
                        <td>{{ $categorie->updated_at }}</td>

                        <td>
                            <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST"
                                style="display: inline;">
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
