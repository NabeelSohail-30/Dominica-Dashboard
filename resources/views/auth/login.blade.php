@extends('layouts.app')

@section('custom_css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">{{ __('Login') }}</div>

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

                    <div class="input-group checkbox-group">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Remember Me') }}</label>
                    </div>

                    <div class="input-group">
                        <button type="submit" class="submit-button">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                            <a class="forgot-password"
                                href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
