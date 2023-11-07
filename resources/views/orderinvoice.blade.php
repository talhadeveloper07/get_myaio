@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row my-5 d-flex justify-content-center'>
    <div class='col-md-8'>
    <div class='order-detail-box'>
        @if(session('success'))
        <div class='alert alert-success'>
            {{session('success')}}
        </div>
        @endif
    <table style='width:100%'>
    @foreach($order as $orderdetail)
    <tr>
        <td class='order-title'>Order# {{$orderdetail->ordernumber}}</td>
        @if($orderdetail->order_status == 'pending')
        <td>
        Your payment is pending
        <a href='{{route("checkout")}}'>Pay Now</a><br>
            <span class='badge bg-danger status my-2'>{{$orderdetail->order_status}}</span>
        </td>
        @elseif($orderdetail->order_status == 'Paid')
        <td><span class='badge bg-success status'>{{$orderdetail->order_status}}</span></td>
        @endif
    </tr>
    <tr>
        <th>Business Information</th>
        <th>Personal Information</th>
    </tr>
    <tr>
        <td>{{$orderdetail->bname}}</td>
        <td>{{$orderdetail->first_name}} {{$orderdetail->last_name}}</td>
    </tr>
    <tr>
        <td>{{$orderdetail->bemail}}</td>
        <td>{{$orderdetail->email}}</td>
    </tr>
    <tr>
        <td>{{$orderdetail->bphone}}</td>
        <td>{{$orderdetail->phone}}</td>
    </tr>
    <tr>
        <td>{{$orderdetail->baddress}}</td>
    </tr>
    @endforeach
    </table>
    <table class='mt-5' style='width:100%;'>
    @foreach($order as $orderdetail)
    <tr class='product-table text-center'>
        <th>Radius Address</th>
        <td>{{$orderdetail->radius_address}}</td>
    </tr>
    <tr class='product-table text-center'>
        <th>Radius</th>
        <td>{{$orderdetail->radius}} miles</td>
    </tr>
    <tr class='product-table text-center'>
        <td><strong>Selected Package</strong><br><span>{{$orderdetail->productdescription}}</span></td>
        <td>{{$orderdetail->productname}}</strong></td>
    </tr>
    <tr class='product-table text-center'>
        <th>Price</th>
        <td>{{$orderdetail->price}}</td>
    </tr>
    <tr class='product-table text-center'>
        <th>Total Price:</th>
        <td class='total'>${{$orderdetail->price}}</td>
    </tr>
    @endforeach
    </table>
    </div>  
</div>
    </div>
</div>

@endsection