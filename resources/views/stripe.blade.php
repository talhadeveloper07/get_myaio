@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row d-flex my-5 justify-content-center'>
        <div class='col-md-7 order-details-col'>
                <table>
                <tr>
                   <th></th>
                    <th style='text-align:right;'><a href='edit-business-details' class='btn btn-primary'>Edit Information</a></th>
                   </tr>
                    @foreach($data as $info)
                    <tr>
                    <th>Business Name</th>
                    <th>Business Email</th>
                   </tr>
                    <tr>
                        <td>{{$info->bname}}</td>
                        <td>{{$info->bemail}}</td>
                    </tr>
                    <tr>
                    <th>Business Phone</th>
                    <th>Business Address</th>
                   </tr>
                    <tr>
                        <td>{{$info->bphone}}</td>
                        <td>{{$info->baddress}}</td>
                    </tr>
                    <tr>
                    <th>Website</th>
                    <th>Description</th>
                   </tr>
                    <tr>
                        <td>{{$info->website_url}}</td>
                        <td>{{$info->description}}</td>
                    </tr>
                    <tr>
                    <th>Radius Address</th>
                    <th>Radius</th>
                   </tr>
                    <tr>
                        <td>{{$info->radius_address}}</td>
                        <td>{{$info->radius}} miles</td>
                    </tr>
                    <tr>
                        <th>Package</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td>{{$info->productname}}</td>
                        <td>${{$info->price}}</td>
                    </tr>

                    @endforeach
                </table>
                <div class='order-save-box'>
                @if(Session::has('paymentpending'))
                    <p class='text-success'><strong>your order information is saved you can pay now and complete your package order.</strong></p>
                    @else
                    <h3 class='text-danger'>Save Order Information & Pay Later</h3>
                    <form action='order-submit' method='post'>
                            @csrf
                        @foreach($data as $info)
                        <input type='hidden' name='client_id' value='{{$info->client_id}}'>
                        <input type='hidden' name='product_id' value='{{$info->pid}}'>
                        @endforeach
                        <button class='btn btn-success' type='submit'>Save order Details</button>
                    </form>
                @endif
                </div>
            </div>

        <div class="col-md-5 payment-col">
            <div class="panel panel-default credit-card-box">
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <h3 class="panel-title">Checkout</h3>
                    <strong>Add your card details to proceed with payments.</strong>
                    <hr>
                    <form 
                            role="form" 
                            action="{{ route('stripe.post') }}" 
                            method="post" 
                            class="require-validation mt-3"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
                    <div class='form-row row mb-3'>
                        <div class='col-md-12 form-group'>
                            <h5><b>Basic Information</b></h5>
                        </div>
                    </div>
                    @foreach($data as $info)
                    <div class='form-row row'>
                            <div class='col-md-6 mb-3 form-group required'>
                                <label class='control-label'>Name on Card</label> 
                                <input class='form-control personalname' size='4' value='{{$info->first_name}} {{$info->last_name}}' type='text'>
                            </div>
                        <div class='col-md-6 mb-3'>
                            <label>Email</label>
                            <input type='email' class='form-control email' value='{{$info->email}}' name='email' required>
                        </div>
                    </div>
                    <strong>Address:</strong>
                    <div class='form-row row'>
                        <div class='col-xs-12 mb-3 form-group required'>
                                <label class='control-label'>Line 1</label> 
                                <input class='form-control line1' name='line1' value='{{$info->address}}' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-md-6 mb-3 form-group required'>
                                <label class='control-label'>Postal Code</label> 
                                <input class='form-control postal_code' name='postal_code'>
                        </div>
                        <div class='col-md-6 mb-3 form-group required'>
                                <label class='control-label'>City</label> 
                                <input class='form-control' name='city'>
                        </div>      
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-6 mb-3 form-group required'>
                                <label class='control-label'>State</label> 
                                <input class='form-control' name='state'>
                        </div>
                        <div class='col-md-6 mb-3 form-group required'>
                                <label class='control-label'>Country</label> 
                                <input class='form-control' name='country'>
                        </div>
                    <div>
                    <hr>
                    </div>
                    <input type='hidden' name='client_id' value='{{$info->client_id}}'>                    
                    <input type='hidden' name='product_id' class='prodid' value='{{$info->pid}}'>
                    @endforeach
                    <div class='form-row row mt-2 mb-3'>
                        <div class='col-md-12 form-group'>
                            <h5><b>Card Details</b></h5>
                        </div>
                    </div>

                        <div class='form-row row mb-3'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row mb-3'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-xs-12">
                            <!-- <input type='hidden' name='product_id' class='prodid'> -->
                            @foreach($data as $package)
                                <button class="btn w-100 btn-primary" type="submit">Pay Now (${{$package->price}})</button>
                                @endforeach
                            </div>
                            <a href="{{ route('payment') }}" class="btn btn-success my-3">Pay (${{$package->price}}) from Paypal</a>
                        </div>
                            
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>

<!-- <script>
    $(document).ready(function(){
        const xd = sessionStorage.getItem('productid');
    $('.prodid').val(xd);
    console.log(xd);
    });
   
</script> -->

@endsection