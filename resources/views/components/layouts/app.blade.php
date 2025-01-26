<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles for Navbar -->
    <style>
        /* Style for the active navbar link with a small white border around text */
        .navbar-nav .nav-link.active {
            border-bottom: 2px solid #ffffff; /* White border at the bottom of the active link */
            color: #ffffff !important; /* Change text color to white */
        }

        /* Change navbar background color to Royal Blue */
        .navbar {
            background-color: #0056b3; /* Royal Blue */
            color: white; /* Default text color */
        }

        /* Style for all navbar links */
        .navbar-nav .nav-link {
            color: white !important; /* Ensure all links are white */
        }

        /* Optional: Style for dropdown menu */
        .dropdown-menu {
            background-color: #0056b3; /* Match the navbar background */
        }

        .dropdown-item {
            color: white !important; /* White text for dropdown items */
        }

        .dropdown-item:hover {
            background-color: #003366; /* Darker blue on hover */
        }

        /* Style specifically for E-Parkir text */
        .navbar-brand {
            color: white !important;  /* White color */
            font-weight: bold;        /* Bold text */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('kendaraan') ? 'active' : '' }}" href="/kendaraan">Jenis Kendaraan</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('inputparkir') ? 'active' : '' }}" href="/inputparkir">Input Parkir</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('bayarparkir') ? 'active' : '' }}" href="/bayarparkir">Bayar Parkir</a>
                        </li>       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</body>
</html>