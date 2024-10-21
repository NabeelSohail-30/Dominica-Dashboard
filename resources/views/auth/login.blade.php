@extends('layouts.app')

@section('content')
    <div class="header">
        <img src="{{ asset('images/app-icon.svg') }}" alt="Logo" class="logo">
        <div class="app-name">Explore Dominica</div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('images/app-icon.svg') }}" alt="Logo" class="logo">
                <h1>Welcome Back! <br> Sign in with your credentials.</h1>
            </div>

            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <label for="email" class="input-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="input-field @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password" class="input-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group row">
                        <div class="check">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        <a class="forgot-password" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                    </div>

                    <div class="input-group">
                        <button type="submit" class="submit-button">{{ __('Sign In') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="copyright">
            &copy; Copyright 2024. by Explore Dominica, All rights reserved.
        </div>
        <div class="links">
            <a href="#">Help</a>
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
    </div>
@endsection

@section('custom_css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection
