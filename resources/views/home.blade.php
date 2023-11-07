@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class='complete-profile-msg py-5 mt-5'>
                <h2>Hello, {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
                <hr>
        
            @if(session('ordercompleted'))
            <div>
            <span>{{session('ordercompleted')}} 
            @foreach($order as $orders)    
            <a href='orderdetail/{{$orders->client_id}}'>CLICK HERE</a></span><br>
            @endforeach
            </div>
            @elseif(session('orderpending'))
            <div>
            <strong>{{session('orderpending')}}</strong><br>
            <a class='btn btn-warning mt-4' href='{{ route("checkout")}}'>Complete your order Now</a>
            </div>
            @elseif(session('infopending'))
            <div>
            <strong>{{session('infopending')}}</strong><br>
            <a class='btn btn-primary mt-4' href='{{ route("add-business-details")}}'>Add Business Details</a>
            </div>
           @endif
            </div>
           
        </div>
    </div>
</div>
@endsection
