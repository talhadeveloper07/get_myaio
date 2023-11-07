<html>
    <head>
    <meta charset="utf-8">
    <title>MyAIO Invoice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
          body{margin-top:20px;
background-color:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
        </style>
    </head>
<body>

<div class="container">
<div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card p-3">
                <!-- card start -->

                @foreach($orderdetail as $order)
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end text-end font-size-15">Invoice #{{strtoupper($order->ordernumber)}} <br><span class="badge mt-2 bg-success font-size-12 ms-2">{{$order->order_status}}</span></h4>
                        <div class="mb-4">
                            <img src='/open-ai-logo.png' width='80px'>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">2424A W Devon Ave, Suite A, Chicago, IL 60659</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>hello@toppagerankers.com</p>
                            <p><i class="uil uil-phone me-1"></i>+1 866-443-6528</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">{{$order->first_name}} {{$order->last_name}}</h5>
                                <p class="mb-1">{{$order->address}}</p>
                                <p class="mb-1">{{$order->email}}</p>
                                <p>{{$order->phone}}</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p>{{$order->created_at->format('m/d/Y')}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p>#{{strtoupper($order->ordernumber)}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Business Information:</h5>
                                <h5 class="font-size-15 mb-2">{{$order->bname}}</h5>
                                <p class="mb-1">{{$order->bemail}}</p>
                                <p class="mb-1">{{$order->bphone}}</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Radius Address</h5>
                                    <p>{{$order->radius_address}} Miles</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Radius</h5>
                                    <p>{{strtoupper($order->radius)}} Miles</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="py-2 mt-4">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1">{{$order->productname}} - {{$order->radius}} Miles Radius</h5>
                                                <p class="text-muted mb-0">{{$order->productdescription}}</p>
                                            </div>
                                        </td>
                                        <td>${{$order->price}}</td>
                                        <td class='text-center'>1</td>
                                        <td class="text-end">${{$order->price}}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                        <td class="text-end">${{$order->price}}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Discount :</th>
                                        <td class="border-0 text-end">$0.00</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Shipping Charge :</th>
                                        <td class="border-0 text-end">$0.00</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Tax</th>
                                        <td class="border-0 text-end">$0.00</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold">${{$order->price}}</h4></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div>
                </div>
                @endforeach
                <!-- card end -->
            </div>
        </div><!-- end col -->
    </div>
</div>

</body>
</html>