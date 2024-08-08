@extends('layouts.app')

@section('title')
    Login
@endsection
@section('content')
    <div class="fxt-content">
        <h2>Login into your account</h2>
        <div class="fxt-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Enter PassWord">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                        <div class="fxt-checkbox-area">
                            <div class="checkbox">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="checkbox1"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label for="checkbox1">Keep me logged in</label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="switcher-text" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                        <button type="submit" class="fxt-btn-fill">Log in</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="fxt-footer">
            <div class="fxt-transformY-50 fxt-transition-delay-9">
                <p>Don't have an account?<a href="{{ route('register') }}" class="switcher-text2 inline-text">Register</a>
                </p>
            </div>
        </div>
    </div>
@endsection
