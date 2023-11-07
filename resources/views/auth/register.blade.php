@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex align-item-center login-row">
        <div class="col-md-5 px-0 form-col">
        <div class="card border-0">
                <div class="card-body form-card">
                <h2 style='font-weight:bold;'>Create An Account</h2>
                    <p style='font-size:14px;'>Enter Your Personal Information to create an account.</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group mb-3">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder='First Name' value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group mb-3">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder='Last Name' value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                        <div class="form-group mb-3">     
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder='Email' name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder='Phone' value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder='Address' value="{{ old('address') }}" autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder='Password' name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="password-confirm" type="password" class="form-control" placeholder='Confirm Password' name="password_confirmation" autocomplete="new-password">
                        </div>
                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link text-secondary text-end" style='width:100%;' href="{{ route('login') }}">
                                        {{ __('Back to Login?') }}
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
