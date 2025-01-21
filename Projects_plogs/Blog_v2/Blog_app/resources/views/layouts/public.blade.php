<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/sass/public.scss'])
</head>

<body class="bg-gray-100 text-gray-800">
    <div id="app">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
                    Blog
                </a>
                <div class="flex space-x-4">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
                    @endif
                    @else
                    <div class="relative">
                        <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none text-gray-700 hover:text-blue-600">
                            <span>{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md">
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
                                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>

                    @endguest
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-8">
            <div class="container mx-auto px-4">
                @yield('content')
            </div>
        </main>

        <footer class="app-footer text-center">
            <strong>
                Copyright &copy; 2024&nbsp;
            </strong>
            All rights reserved.
        </footer>
    </div>

    <script>
        // Toggle dropdown visibility
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Optional: Close dropdown if clicked outside
        window.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    @vite(['resources/js/public.js'])
</body>

</html>