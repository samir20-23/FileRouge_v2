{{-- resources/views/layouts/stylepages.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-dNmYX0fCrGZtUgIqlr4O/ZZSjf9SOVnlcTsgze7vh6eGZlXBv0xgTwKtoDCN/0r8cErraY+CnKXkkQtvv7MXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- Make sure Font Awesome is properly loaded -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-dNmYX0fCrGZtUgIqlr4O/ZZSjf9SOVnlcTsgze7vh6eGZlXBv0xgTwKtoDCN/0r8cErraY+CnKXkkQtvv7MXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Your other CSS files: --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
    <style>
        :root {
            /* Light Mode Colors */
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary-color: #f8fafc;
            --accent-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;

            /* Text Colors */
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;

            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-card: #ffffff;

            /* Border & Shadow */
            --border-color: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            --gradient-bg: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
            --gradient-card: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }

        [data-theme="dark"] {
            /* Dark Mode Colors */
            --primary-color: #818cf8;
            --primary-dark: #6366f1;
            --primary-light: #c7d2fe;
            --secondary-color: #1e293b;
            --accent-color: #34d399;
            --warning-color: #fbbf24;
            --danger-color: #f87171;
            --info-color: #60a5fa;

            /* Text Colors */
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;

            /* Background Colors */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-card: #1e293b;

            /* Border & Shadow */
            --border-color: #334155;
            --border-light: #475569;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3), 0 2px 4px -2px rgb(0 0 0 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3), 0 4px 6px -4px rgb(0 0 0 / 0.3);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.3);

            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            --gradient-bg: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            --gradient-card: linear-gradient(145deg, #1e293b 0%, #334155 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--gradient-bg);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .navbar-custom {
            background: rgba(30, 41, 59, 0.95);
            border-bottom-color: var(--border-color);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-brand:hover {
            color: var(--primary-dark) !important;
            transform: translateY(-2px);
        }

        .navbar-brand .bi {
            font-size: 1.75rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .lockscreen-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: 2rem;
        }

        .lockscreen-logo img {
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .lockscreen-logo img:hover {
            transform: scale(1.05) rotate(2deg);
            box-shadow: var(--shadow-lg);
        }

        /* Navigation Links */
        .navbar-nav .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            padding: 0.75rem 1.25rem !important;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 0 0.25rem;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(79, 70, 229, 0.05));
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--gradient-primary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-nav .nav-link:hover::before {
            width: 80%;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: 16px;
            padding: 0.75rem;
            margin-top: 0.75rem;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            min-width: 220px;
        }

        .dropdown-item {
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            font-weight: 600;
            color: var(--text-secondary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .dropdown-item:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateX(6px);
            box-shadow: var(--shadow-md);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* User Avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
            margin-right: 0.75rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-lg);
        }

        /* Sidebar Enhancements */
        .sidebar-offcanvas {
            width: 320px;
            background: var(--bg-card);
            box-shadow: var(--shadow-xl);
            border: none;
        }

        .sidebar-offcanvas .offcanvas-header {
            height: 80px;
            padding: 1.5rem;
            background: var(--gradient-card);
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-user {
            background: var(--bg-secondary);
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .sidebar-user:hover {
            background: var(--bg-tertiary);
        }

        .sidebar-user .user-avatar {
            width: 48px;
            height: 48px;
            font-size: 1.1rem;
            margin-right: 1rem;
        }

        /* Navigation Links Container */
        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--text-secondary) !important;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 0.25rem 1rem;
            border-radius: 12px;
            text-decoration: none;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.2rem;
            width: 28px;
            text-align: center;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: var(--gradient-primary);
            color: white !important;
            transform: translateX(8px);
            box-shadow: var(--shadow-md);
        }

        .sidebar-nav .nav-link:hover i,
        .sidebar-nav .nav-link.active i {
            color: white !important;
            transform: scale(1.1);
        }

        .sidebar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: white;
            border-radius: 2px;
        }

        /* Dark Mode Toggle */
        #darkModeToggle {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #darkModeToggle:hover {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Main Content */
        .content-main {
            background: var(--bg-card);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            border: 1px solid var(--border-color);
            margin: 2rem auto;
            max-width: 1400px;
            transition: all 0.3s ease;
        }

        .content-main:hover {
            box-shadow: var(--shadow-xl);
        }

        /* Utility Classes */
        .text-gradient {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            color: white;
        }

        /* Animations */
        @keyframes logoPulse {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.05) rotate(2deg);
            }
        }

        .img-logo {
            animation: logoPulse 6s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .lockscreen-logo {
                display: none;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .content-main {
                margin: 1rem;
                padding: 2rem;
                border-radius: 16px;
            }

            .sidebar-offcanvas {
                width: 280px;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Selection */
        ::selection {
            background: var(--primary-color);
            color: white;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        /* Focus States */
        .btn:focus,
        .nav-link:focus,
        .dropdown-item:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
        /* darkmode
        body.dark-mode .card {
    background-color: #404040 !important;
    border-color: #404040 !important;
    color: #4d4f97 !important;
} */
    </style>
    @stack('styles')
</head>

<body data-theme="light">
    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom animate-fade-in-up">
        <div class="container-fluid">
            {{-- Sidebar Toggle --}}
            <button class="btn btn-link text-secondary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar" aria-label="Toggle sidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            {{-- Brand / Logo --}}
            <a class="navbar-brand ms-2" href="{{ url('/') }}">
                <i class="bi bi-lightning-charge-fill"></i>
                @if (config('adminlte.logo_img'))
                    <img src="{{ asset(config('adminlte.logo_img')) }}" height="40" alt="Logo" class="img-logo">
                @endif
                <span class="text-gradient">{{ config('app.name', 'SoliLMS') }}</span>
            </a>
            {{-- Navbar Collapse --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house me-1"></i>Home
                        </a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <button id="darkModeToggle" class="btn me-3">
                                <i class="bi bi-moon-fill"></i>
                                <span class="d-none d-md-inline">Dark</span>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear"></i>Settings
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Sidebar Offcanvas --}}
    <div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="sidebar"
        aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-lightning-charge-fill"></i>
                @if (config('adminlte.logo_img'))
                    <img src="{{ asset(config('adminlte.logo_img')) }}" height="40" alt="Logo"
                        class="img-logo">
                @endif
                <span class="text-gradient">{{ config('app.name', 'SoliLMS') }}</span>
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            @auth
                <div class="sidebar-user">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ Auth::user()->name }}</div>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                </div>
            @endauth

            <nav class="nav flex-column sidebar-nav">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
                <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    Settings
                </a>
                <a class="nav-link {{ request()->routeIs('reports') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-line"></i>
                    Reports
                </a>
                <a class="nav-link" id="exportData">
                    <i class="bi bi-download"></i>
                    Export Data
                </a>
                <a class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i>
                    Help
                </a>
            </nav>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="content-main animate-fade-in-up">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Dark Mode Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const icon = darkModeToggle.querySelector('i');
            const text = darkModeToggle.querySelector('span');

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);

            darkModeToggle.addEventListener('click', function() {
                const currentTheme = body.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                setTheme(newTheme);
            });

            function setTheme(theme) {
                body.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);

                if (theme === 'dark') {
                    icon.className = 'bi bi-sun-fill';
                    if (text) text.textContent = 'Light';
                } else {
                    icon.className = 'bi bi-moon-fill';
                    if (text) text.textContent = 'Dark';
                }

                // Dispatch custom event for charts
                window.dispatchEvent(new CustomEvent('themeChanged', {
                    detail: {
                        theme
                    }
                }));
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
