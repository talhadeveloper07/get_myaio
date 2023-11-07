@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row mt-5 d-flex justify-content-center'>
      <div class='col-md-7 text-center'>
        <h2>Your Package on your given radius is given below.</h3>
      </div>
    </div>
    <div class='row my-5 d-flex justify-content-center'>
    @foreach($data as $package)
        <div class='col-md-3'>
            <div class='package-box'>
                <div class='package-head text-center'>
                    <h2>${{$package->price}}</h2>
                    <h5>{{$package->productname}}</h5>
                </div>
                <div class='package-detail p-3 text-center'>
                    <strong>{{$package->productdescription}}</strong>
                </div>
                <div class='package-btn-box text-center'>
                    <input type='hidden' value='{{$package->id}}' class='pid'> 
                    <!-- <a class='btn btn-success pid-btn' href="order/{{$package->id}}">Select Package</a> -->
                    <form method='post' action='{{ route("order") }}'>
                        @csrf
                        <input type='hidden' name='pid' value='{{$package->id}}'/>
                        <button class='btn btn-success' type='submit'>Select Package</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

<script>
    $(document).ready(function(){
     $('.pid-btn').click(function(){
        sessionStorage.setItem('productid', $('.pid').val());
     });
    });
</script>


@endsection