<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessInformation;
use App\Models\User;
use App\Models\Order;



class HomeController extends Controller
{
    /**
     * 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $data = BusinessInformation::where('client_id', Auth()->User()->id)->get();
       if($data->isNotEmpty())
       {
        $order = Order::where('client_id',  Auth()->User()->id)->get();
        if($order->isNotEmpty())
        {   
            session()->put('ordercompleted','you can check your order details by');
            return view('home')->with('order',$order);
        } 
        else{            
            session()->put('orderpending','Your order is pending, to complete the order click the button below.');
            return view('home');
        }
       }
        session()->put('infopending','please add your business information to complete your business profile');
        return view('home');
              
        
    }

    public function add_business_view()
    {
        return view('addbusiness');
    }
    public function add_profile_view()
    {
        return view('addprofile');
    }
    public function add_radius_view()
    {
        return view('addradius');
    }
    public function select_package_view()
    {
        return view('packages');
    }

    public function customer_order_view(Request $request){
        $orderdetail = Order::where('orders.client_id',$request->id)
        ->join('business_information','business_information.client_id','=','orders.client_id')
         ->join('products','products.id','=','orders.product_id')
         ->join('users','users.id','=','orders.client_id')
         ->select('orders.id AS orderid','orders.ordernumber','orders.order_status', 'orders.client_id AS clientid', 'orders.product_id AS productid','orders.created_at','business_information.bname AS bname','business_information.bemail AS bemail','business_information.bphone AS bphone', 'business_information.baddress AS baddress','business_information.website_url', 'business_information.radius_address','business_information.radius','products.productname AS productname', 'products.price','products.productdescription','users.first_name','users.last_name','users.email','users.phone','users.address')
        ->get();   
return view('orderdetail')->with('orderdetail',$orderdetail);
    }
}
