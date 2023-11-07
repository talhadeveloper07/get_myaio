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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
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
        ajax: "{{ route('allusers') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name'},
            {data: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });
      
  });
</script>

@endsection

  