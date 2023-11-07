@extends('layouts.app')

@section('content')
<div class='container-fluid h-100 main-sec bg-white'>
      <div class='row h-100 d-flex align-items-center'>
      <div class="col-md-6 p-0 py-4 h-100">
        <div class="form-col">
          <h2 class="text-center mt-3" style='font-weight:bold;'>Profile Information</h2>  
          <p style='font-size:14px;' class='pb-3 text-center'>Add your Personal profile information below.</p>
           <form>
            @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group my-3">
                        <input type="text" class="form-control" id="fname" placeholder="First Name">
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group my-3">
                        <input type="text" class="form-control" id="lname" placeholder="Last Name">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">   
                        <input type="email" class="form-control" id="email" value="{{Auth::User()->email}}" placeholder="Email Address" disabled>
                          </div>
                      </div>
                       <div class="col-md-6">
                          <div class="form-group">   
                        <input name='phone' id='phone' class='form-control' placeholder='Phone Number'>
                          </div>
                      </div>
                    </div>
                    <div class='row my-3'>
                        <div class='col-md-4'>
                            <input class='form-control' name='country' placeholder='Country' id='country'>
                        </div>
                        <div class='col-md-4'>
                            <input class='form-control' name='state' placeholder='State' id='state'>
                        </div>
                        <div class='col-md-4'>
                            <input class='form-control' name='zip' placeholder='Zip' id='zip'>
                        </div>
                    </div>
                    <div class="form-group my-3">                       
                       
                   </div> 
                    <div class="form-group my-3">
                        <textarea name='address' id='address' class='form-control' placeholder='Address'></textarea>
                    </div>

                    <div class="form-group my-3">
                       <button type='submit' class='btn btn-primary' style='width:100%;'>Add Personal Detail</button>
                    </div>

                    </form>
        </div>
                
          
          </div> 
      <div class="col-md-6 p-0">
         
          </div> 
      </div>
    </div>
</div>

@endsection

