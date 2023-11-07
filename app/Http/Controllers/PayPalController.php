<?php
  
namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Facades\PayPal; 
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\BusinessInformation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Traits\OrderTrait;
use Redirect;
use Mail;
   
class PayPalController extends Controller
{
    use OrderTrait;

    public function generateRandomString($length = 8) {
        $characters = 'OPNTPR5656';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomString;
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $business_info = BusinessInformation::where('client_id',Auth()->User()->id)
        ->join('users','users.id','=','business_information.client_id')
        ->join('products','products.id','=','business_information.pid')
        ->get();

        foreach($business_info as $business)
                    {
                        $price = $business->price; 

                    }
        $data = [];
        $p = $price;
        $invoicestring = $this->generateRandomString(7);
        $data['items'] = [
            [
                'name' => 'My AIO Portal',
                'price' => $p,
                'desc'  => 'Description for get.myaio.com',
                'qty' => 1
            ]
        ];
        
        $data['invoice_id'] = $invoicestring;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $p;
  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        // $invoiceid = $provider->getExpressCheckoutDetails('invoice_id');
        // dd($response['PAYMENTREQUEST_0_DESC']);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            if(Order::where('client_id',Auth()->User()->id)->exists())
            
        {
            $status = 'Paid';
            
        Order::where('client_id',Auth()->User()->id)->update(['order_Status'=>$status]);
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
        
        }else{

            $pid  = BusinessInformation::where('client_id',Auth()->User()->id)->get('pid');
            foreach($pid as $productid)
            {
                $product_id = $productid->pid;
            }
            $order = [
                'client_id'=>Auth()->User()->id,
                'product_id'=>$product_id,
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
            return view('ordersuccess');
            dd('Your payment was successfully. You can create success page here.');
        }
  
        dd('Something is wrong.');
    }

    public function paypal()
    {
        return view('paypal');
        }


       
}