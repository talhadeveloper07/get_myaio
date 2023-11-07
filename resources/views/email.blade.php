<div style='width: 60%;margin:auto;padding: 30px;box-shadow: 0px 0px 20px -4px #c1e5ff;border-radius: 8px;'>
    <table style='width:100%'>
    <tr>
        <td>Order #{{$ordernumber}}</td>
        @if($status == 'Payment Confirmed')
        <td style='text-align: right;padding-bottom:10px;'><span style='background: #198754;border-radius: 6px;padding: 3px 8px;'>{{$status}}</span></td>
        @else
        <td style='text-align: right;padding-bottom:10px;'><span style='background: #DD3545;border-radius: 6px;padding: 3px 8px;'>{{$status}}</span></td>
        @endif
    </tr>
    <tr>
        <th style='text-align: left;'>Business Information</th>
        <th style='text-align: right;'>Personal Information</th>
    </tr>
    <tr>
        <td>{{$bname}}</td>
        <td style='text-align: right;'>{{$first_name}} {{$last_name}}</td>
    </tr>
    <tr>
        <td>{{$bemail}}</td>
        <td style='text-align: right;'>{{$email}}</td>
    </tr>
    <tr>
        <td>{{$bphone}}</td>
        <td style='text-align: right;'>{{$phone}}</td>
    </tr>
    <tr>
        <td>{{$baddress}}</td>
    </tr>
    </table>
    <table border='1px' cellspacing="0" style='width:100%;margin-top: 15px;'>
    <tr>
        <th style="padding:10px;">Radius Address</th>
        <td style="padding:10px;">{{$radiusaddress}}</td>
    </tr>
    <tr>
        <th style="padding:10px;">Radius</th>
        <td style="padding:10px;">{{$radius}} miles</td>
    </tr>
    <tr>
        <td style="padding:10px;text-align: center;"><strong>Selected Package</strong><br><span>{{$pdesc}}</span></td>
        <td style="padding:10px;">{{$pname}}</strong></td>
    </tr>
    <tr>
        <th style="padding:10px;">Price</th>
        <td style="padding:10px;">{{$price}}</td>
    </tr>
    <tr>
        <th style="padding:10px;">Total Price:</th>
        <td style="padding:10px;">${{$price}}</td>
    </tr>
    </table>
   
</div>
