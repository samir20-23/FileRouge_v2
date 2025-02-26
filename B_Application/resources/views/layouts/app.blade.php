@extends('adminlte::page')

@section('title', 'Page Title')
 
@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush


@section('content_header')
    <h1>Page Header</h1>
@stop

@section('content')
    <p>Page Content</p>
@stop
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush