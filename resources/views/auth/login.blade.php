@extends('layouts.app')

@section('content')
<style>
    /* Background set to white */
    body {
        background-color: #f9f9f9; /* White background */
        color: #333; /* Dark text color for better readability */
    }

    /* Card Header Styling */
    .card-header {
        background-color: #3498db; /* Blue background for the dashboard */
        color: white; /* White text for contrast */
        font-size: 1.3rem; /* Slightly larger font size */
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 10px 18px; /* Added some padding for balance */
    }

    /* Card Styling */
    .card {
        background-color: #ffffff; /* White background for the card */
        border-radius: 12px; /* Rounded corners for the card */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); /* Larger and deeper shadow for prominence */
        padding: 30px; /* Padding inside the card */
        margin-top: 50px; /* Space from the top of the page */
        max-width: 500px; /* Limit the card width */
        width: 100%; /* Full width up to max-width */
        min-height: 400px; /* Increased height for the card */
        margin-left: auto; /* Center the card */
        margin-right: auto; /* Center the card */
        border: 1px solid #ddd; /* Light border to enhance definition */
        transition: all 0.3s ease; /* Smooth transition for hover effect */
    }

    .card:hover {
        transform: translateY(-10px); /* Lift the card on hover */
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
    }

    /* Form Control Styling */
    .form-control {
        background-color: #f8f9fa; /* Light gray input fields */
        border-color: #ccc; /* Light border */
        border-radius: 8px; /* Rounded corners for inputs */
        padding: 10px; /* Padding inside input fields */
        margin-bottom: 15px; /* Spacing between input fields */
    }

    /* Primary Button Styling */
    .btn-primary {
        background-color: #3498db; /* Blue button to match the dashboard */
        border-color: #2980b9; /* Slightly darker blue on hover */
        padding: 10px 20px; /* Padding inside the button */
        border-radius: 8px; /* Rounded corners for the button */
        font-weight: bold;
        width: 100%;
        transition: background-color 0.3s ease; /* Smooth color transition */
    }

    .btn-primary:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #2471a3;
    }

    /* Button Link Styling */
    .btn-link {
        color: #3498db; /* Blue link color */
        text-decoration: none;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline; /* Underline effect on hover */
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">{{ __('E-Parkir') }}</div>

                <!-- Card Body -->
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button and Forgot Password Link -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
