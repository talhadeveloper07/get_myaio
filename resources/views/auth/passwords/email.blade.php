@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex align-item-center login-row">
        <div class="col-md-5 px-0 form-col p-0">
            <div class="card border-0 bg-white">
                <h2 style='font-weight:bold;'>{{ __('Reset Password') }}</h2>
                <p style='font-size:14px;'>Enter your registered email address. We will send you a link to reset your password.</p>

                <div class="card-body form-card p-0 py-3">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class='form-group'>
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror py-2" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder='Enter Email'>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group my-3">

                                <button type="submit" class="btn btn-primary py-2" style='width:100%'>
                                    {{ __('Reset Password') }}
                                </button>
                          
                        </div>
                        <a class="btn btn-link text-secondary text-end" style='width:100%;' href="{{ route('login') }}">
                                        {{ __('Back to Login?') }}
                                    </a>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-md-7 px-0 login-img-col'>
              
              </div>
    </div>
</div>
@endsection
