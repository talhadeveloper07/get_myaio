@extends('layouts.app')

@section('content')

<div class='container'>
<div class='row d-flex justify-content-center'>
        <div class='col-md-8 py-5 mt-5 text-center'>
            <a href='{{ route("allusers") }}' class='btn btn-primary'>Customers</a>
            <a class='btn btn-warning'>Business Details</a>
            <a href='{{ route("orderslist") }}'  class='btn btn-info'>Orders</a>
        
        </div>
    </div>
    <div class='row d-flex justify-content-center'>
        <div class='col-md-6'>
            <h2 class='text-center my-4'>Update User Information</h2>
        <form method="POST" action="">
                        @csrf

                        @foreach($singleuser as $user)
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group mb-3">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder='First Name' value="{{ $user->first_name }}" autocomplete="first_name" autofocus>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group mb-3">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder='Last Name' value="{{ $user->last_name }}" autocomplete="last_name" autofocus>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                        <div class="form-group mb-3">     
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder='Email' name="email" value="{{ $user->email }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder='Phone' value="{{ $user->phone }}" autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder='Address' value="{{ $user->address }}" autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-success w-100">
                                  Update Client
                                </button>
                        </div>
                        @endforeach
                    </form>
        </div>
    </div>
</div>

@endsection