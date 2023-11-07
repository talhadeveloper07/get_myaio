@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row d-flex my-5 justify-content-center'>
        <div class='col-md-7 order-info-box'>
            <div class='business-order-box'>
            <h2>Business Information</h2>      
            <ul class='business-info-list'>
            @foreach($data as $info)
            <li><strong>Name:</strong> {{$info->bname}}</li>
            <li><strong>Email: </strong>{{$info->bemail}}</li>
            <li><strong>Business Phone: </strong>{{$info->bphone}}</li>
            <li><strong>Business Address: </strong>{{$info->baddress}}</li>
            <li><strong>Website Link: </strong>{{$info->website_url}}</li>
            <li><strong>Description</strong>
            @if($info->description)
                {{$info->description}}
            @else
                --
            @endif
            </li>
            <li><strong>Radius Address: </strong>{{$info->radius_address}}</li>      
            <li><strong>Radius: </strong>{{$info->radius}} miles</li>
           
            <li><strong>Package: </strong>{{$info->productname}}</li>
            <li><strong>Price: </strong>${{$info->price}}</li>
            @endforeach    
            </ul>
                <a class='btn btn-warning mx-2' href='{{ route("edit-business-details") }}'>Edit Information</a>
                <a class='btn btn-success' href='{{route("checkout")}}'>Proceed to checkout</a>          
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



@endsection