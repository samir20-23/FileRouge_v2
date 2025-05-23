@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Document Details</h2>
    <p><strong>Title:</strong> {{ $document->title }}</p>
    <p><strong>File:</strong> <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View</a></p>
    <p><strong>Category:</strong> {{ $document->category->label ?? 'N/A' }}</p>
    <p><strong>Uploaded By:</strong> {{ $document->user->name ?? 'Unknown' }}</p>
</div>
@endsection
