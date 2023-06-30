@extends('auth.auth_layout')
@section('heading')
    Login
@endsection

@section('content')
    
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Username') }} <span class="login-danger">*</span></label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                <span class="profile-views"><i class="fas fa-user"></i></span>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Password') }} <span class="login-danger">*</span></label>
                                <input id="password" type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span class="profile-views feather-eye toggle-password"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="forgotpass">
                                <div class="remember-me">
                                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> {{ __('Remember Me') }}
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">{{ __('Login') }}</button>
                            </div>
                        </form>

@endsection