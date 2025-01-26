@extends('layouts.app')

@section('content')
<style>
    /* Custom Styles for Navbar */
    .navbar {
        background-color: #0056b3 !important;
        color: white;
    }

    .navbar-brand {
        color: white !important;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        color: white !important;
    }

    .navbar-nav .nav-link.active {
        border-bottom: 2px solid #ffffff;
        color: #ffffff !important;
    }

    .dropdown-menu {
        background-color: #0056b3;
    }

    .dropdown-item {
        color: white !important;
    }

    .dropdown-item:hover {
        background-color: #003366;
    }

    /* Body and Form Styling */
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        margin-top: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        width: 60%;
        display: flex;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
        max-width: 900px;
    }

    /* Mengatur ukuran gambar */
    .login-card img.main-img {
        width: 35%; /* Atur lebar gambar menjadi 25% */
        height: auto; /* Menjaga rasio gambar tetap proporsional */
    }

    .login-card .card-body {
        flex: 1;
        padding: 30px;
        background-color:  #f9f9f9;
    }

    /* Card Header Styling */
    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 1.3rem;
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px 18px;
        text-align: center;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    /* Button Login Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-link {
        color: #007bff;
    }

    .btn-link:hover {
        color: #0069d9;
    }
</style>

<div class="container login-container">
    <div class="login-card">
        <!-- Gambar utama -->
        <img class="main-img" src="{{ asset('images/login.png') }}" alt="Login Image">
        <div class="card-body">
            <div class="card-header">
                {{ __('E-Parkir') }}
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                <a class="btn btn-link mt-2 d-block text-center" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
