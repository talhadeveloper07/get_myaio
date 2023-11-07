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
            <div class='col-md-10'>
            <table id="example" class="table table-striped data-table" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client ID</th>
                <th>Product ID</th>
                <th>Order Number</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
  $(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orderslist') }}",
        columns: [
            {data: 'id'},
            {data: 'client_id'},
            {data: 'product_id'},
            {data: 'ordernumber'},
            {data: 'order_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });
      
  });
</script>

@endsection

  