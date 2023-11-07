<?php

namespace App\Http\Controllers;
use App\Models\BusinessInformation;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

use App\Traits\OrderTrait;

use Illuminate\Http\Request;
use Session;
use Redirect;
use Mail;

class OrderController extends Controller
{
    use OrderTrait;

    public function order_view(Request $request)
    {
        $package = BusinessInformation::where('client_id',Auth()->user()->id)
                                        ->update([
                                            'pid' => $request->pid,
                                        ]);
        $business_info = BusinessInformation::where('business_information.client_id',Auth()->User()->id)
                                            ->join('users','users.id','=','business_information.client_id')
                                            ->join('products','products.id','=','business_information.pid')
                                            ->get();
        $product = $this->get_single_product($request->pid);
        return view('order')->with(['data'=>$business_info, 'product'=>$product]);
    }

    public function order_submit(Request $request)
    {       
        $validator = Validator::make($request->all(),[
            'client_id'=>'required|unique:orders',
           'product_id'=>'required',
        ]);

        if ($validator->fails()){
            return redirect('/');
        }
        else
        {
            $order = [
                'client_id'=>$request->client_id,
                'product_id'=>$request->product_id,
                'ordernumber'=>Str::random(5),
                'order_status' => 'pending'
            ];
            Order::create($order);  
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
            return view('orderinvoice')->with(['order'=>$business_info]);
        }
    }
    public function ordercompleted()
    {
        return view('order-completed');
    }

    public function ordersearch(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ordernumber'=>'required',
        ]);
    
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        else{
            $data = Order::where('ordernumber',$request->ordernumber)->get();

        if(Order::where('ordernumber',$request->ordernumber)->exists())
        {
            foreach($data as $order)
            {
                $clientid = $order->client_id;
                $productid = $order->product_id;
            }   
            $orderdetail = Order::where('orders.client_id',$clientid)
            ->where('orders.client_id',Auth()->User()->id)
            ->join('business_information','business_information.client_id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('users','users.id','=','orders.client_id')
            ->select('orders.id AS orderid','orders.ordernumber','orders.order_status','orders.created_at', 'orders.client_id AS clientid', 'orders.product_id AS productid','business_information.bname AS bname','business_information.bemail AS bemail','business_information.bphone AS bphone', 'business_information.baddress AS baddress','business_information.website_url', 'business_information.radius_address','business_information.radius','products.productname AS productname', 'products.price','products.productdescription','users.first_name','users.last_name','users.email','users.phone')
            ->get();    
            return view('orderdetail')->with('orderdetail',$orderdetail);
        }
        else{
            return redirect('/');
        }
            }                
    }
}
