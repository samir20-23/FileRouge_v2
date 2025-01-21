@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Welcome to AdminLTE</h1>
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Rouge</title>
</head>
<body>
    <header>
        <!-- Navigation, logo, etc. -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>

 
@endsection
