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
</div>

<h1 class='text-center'>Welcome Admin</h1>

@endsection