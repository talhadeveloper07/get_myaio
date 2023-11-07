@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex align-item-center login-row">
        <div class="col-md-5 px-0 form-col">
            <div class="card border-0">
                <div class="card-body form-card">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <h2 style='font-weight:bold;'>Login</h2>
                    <p style='font-size:14px;'>Enter your credentials to access your account</p>
                        <div class="form-group my-3">
                            <label for="email">{{ __('Email Address') }}</label>
                         
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror bg-white py-2" placeholder='Enter Email' name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror bg-white py-2"  placeholder='Enter Password' name="password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class='row d-flex align-items-center'>
                                <div class='col-md-5'>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label style='font-size:12px;' class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                </div>
                                <div class='col-md-7'>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-secondary text-end" style='width:100%;' href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group my-4">
                                <button type="submit" class="btn btn-primary" style='width:100%;'>
                                    {{ __('Login') }}
                                </button>
                                <a class="btn btn-link text-secondary text-end" style='width:100%;' href="{{ route('register') }}">
                                        {{ __('Sign Up/Register') }}
                                    </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-md-7 px-0 login-img-col'>
              
            </div>
    </div>
</div>
@endsection
