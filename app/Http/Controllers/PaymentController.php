<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\BusinessInformation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Traits\OrderTrait;
use Mail;

class PaymentController extends Controller
{
    use OrderTrait;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripe(Request $request)
    {
        $business_info = BusinessInformation::where('client_id',Auth()->User()->id)
        ->join('users','users.id','=','business_information.client_id')
        ->join('products','products.id','=','business_information.pid')
        ->get();
        // dd($business_info);
        $product = $this->get_single_product($request->packageid);
        if(BusinessInformation::where('client_id',Auth()->User()->id)->exists())
        {
           $status =  Order::where('client_id',Auth()->user()->id)->get();
           if(Order::where('client_id',Auth()->User()->id)->exists()){
            foreach($status as $stat)
            {
                $statuss = $stat->order_status;
            }
            if($statuss == 'pending')
            {      
                session()->put('paymentpending','order saved & payment pending');
                return view('stripe')->with(['data'=>$business_info, 'product'=>$product]);
            }
            else{            
                return view('stripe')->with(['data'=>$business_info, 'product'=>$product]);
            }  
           }
           else{    
            return view('stripe')->with(['data'=>$business_info, 'product'=>$product]);
           }            
        }
        else{
            session()->put('infopending','please add your business information to complete your business profile');
            return view('home');
        }
        
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   /**

 * success response method.

 *

 * @return \Illuminate\Http\Response

 */

public function stripePost(Request $request)

{
    
    try{

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

  

    $customer = Stripe\Customer::create(array(

            "address" => [

                    "line1" => $request->line1,

                    "postal_code" => $request->postal_code,

                    "city" => $request->city,

                    "state" => $request->state,

                    "country" => $request->country,

                ],

            "email" => $request->email,

            "name" => $request->name,

            "source" => $request->stripeToken

         ));

  

    Stripe\Charge::create ([

            "amount" => 10 * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Payment from myaio portal",

            "shipping" => [

              "name" => "Jenny Rosen",

              "address" => [

                "line1" => "510 Townsend St",

                "postal_code" => "98140",

                "city" => "San Francisco",

                "state" => "CA",

                "country" => "US",

              ],

            ]

    ]); 
   
        if(Order::where('client_id',$request->client_id)->exists())
        {
            $status = 'Paid';
            
        Order::where('client_id',$request->client_id)->update(['order_Status'=>$status]);
        if(BusinessInformation::where('client_id',Auth()->User()->id)->exists())
        {   
            $business_info = $this->get_order_invoice();
            foreach($business_info as $business)
                    {
                        $orderno = $business->ordernumber;
                        $orderstat = $business->order_status;
                        $bname = $business->bname;
                        $bemail = $business->bemail;
                        $bphone = $business->bphone;
                        $baddress = $business->baddress;
                        $radius_address = $business->radius_address;
                        $radius = $business->radius;
                        $firstname = $business->first_name;
                        $lastname = $business->last_name;
                        $phone = $business->phone;
                        $email = $business->email;
                        $pname = $business->productname;
                        $pdesc = $business->productdescription;
                        $price = $business->price; 

                    }

                    $maildata = [
                       'ordernumber'=>$orderno,
                       'status'=> $orderstat,
                       'bname'=>$bname ,
                       'bemail'=>$bemail,
                       'bphone'=>  $bphone,
                       'baddress'=>  $baddress,
                       'radiusaddress'=>  $radius_address,
                       'radius'=>  $radius,
                       'first_name'=>$firstname,
                       'last_name'=>$lastname,
                       'phone'=>$phone,
                       'email'=>$email,
                       'pname'=>$pname,
                       'pdesc'=>$pdesc,
                       'price'=>$price,
                    ];
                    $useremail['to'] = $email; 
                    Mail::send('email',$maildata,function($messages) use ($useremail){
                        $messages->to($useremail['to']);
                        $messages->subject('Pending Order Payment Recieved');
                    });

            Session::flush('success', 'Payment successful!');
            return view('orderinvoice')->with(['order'=>$business_info]);
        }
        else{
            session()->put('infopending','please add your business information to complete your business profile');
            return view('home');
        }
        
        }
    else{
        $validator = Validator::make($request->all(),[
            'client_id'=>'required|unique:orders',
           'product_id'=>'required',
        ]);
    
        if ($validator->fails()){
            return redirect('/');
        }
            else{
                $order = [
                    'client_id'=>$request->client_id,
                    'product_id'=>$request->product_id,
                    'ordernumber'=>Str::random(5),
                    'order_status' => 'Paid'
                ];
                Order::create($order); 
                if(BusinessInformation::where('client_id',Auth()->User()->id)->exists())
                {   
                    $business_info = $this->get_order_invoice();                    
                    foreach($business_info as $business)
                    {
                        $orderno = $business->ordernumber;
                        $orderstat = $business->order_status;
                        $bname = $business->bname;
                        $bemail = $business->bemail;
                        $bphone = $business->bphone;
                        $baddress = $business->baddress;
                        $radius_address = $business->radius_address;
                        $radius = $business->radius;
                        $firstname = $business->first_name;
                        $lastname = $business->last_name;
                        $phone = $business->phone;
                        $email = $business->email;
                        $pname = $business->productname;
                        $pdesc = $business->productdescription;
                        $price = $business->price; 

                    }

                    $maildata = [
                       'ordernumber'=>$orderno,
                       'status'=> $orderstat,
                       'bname'=>$bname ,
                       'bemail'=>$bemail,
                       'bphone'=>  $bphone,
                       'baddress'=>  $baddress,
                       'radiusaddress'=>  $radius_address,
                       'radius'=>  $radius,
                       'first_name'=>$firstname,
                       'last_name'=>$lastname,
                       'phone'=>$phone,
                       'email'=>$email,
                       'pname'=>$pname,
                       'pdesc'=>$pdesc,
                       'price'=>$price,
                    ];
                    $useremail['to'] = $email; 
                    Mail::send('email',$maildata,function($messages) use ($useremail){
                        $messages->to($useremail['to']);
                        $messages->subject('New Order Recieved');
                    });
                    Session::flush('success', 'Payment successful!');
                    return view('orderinvoice')->with(['order'=>$business_info]);
                }
                else{
                    session()->put('infopending','please add your business information to complete your business profile');
                    dd('error');
                    return view('home');
                }
            }
    }    

    }
    catch (\Exception $ex) {
        return $ex->getMessage();
    }

}
}