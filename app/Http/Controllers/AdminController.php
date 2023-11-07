<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use DataTables;
use PDF;
use Response;



class AdminController extends Controller
{

    public function index(){
        return view('admin.admindashboard');
    }
    public function userslist(Request $request){
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                   $btn = '<a href="single-user/'.$row->id.'" class="edit btn btn-secondary btn-sm">View</a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.users');
    }

    public function singleuser(Request $request){
        $singleuser = User::where('id',$request->id)->get();
        return view('admin.viewuser')->with('singleuser',$singleuser);
    }

    public function orderslist(Request $request){

        if ($request->ajax()) {
            $orders = Order::all();
            return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="view-order/'.$row->client_id.'" target="_blank" class="edit btn btn-secondary btn-sm">View</a>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.orderslist');
    }

    public function order_invoice(Request $request){
        $orderdetail = Order::where('orders.client_id',$request->id)
                            ->join('business_information','business_information.client_id','=','orders.client_id')
                             ->join('products','products.id','=','orders.product_id')
                             ->join('users','users.id','=','orders.client_id')
                             ->select('orders.id AS orderid','orders.ordernumber','orders.order_status', 'orders.client_id AS clientid', 'orders.product_id AS productid','orders.created_at','business_information.bname AS bname','business_information.bemail AS bemail','business_information.bphone AS bphone', 'business_information.baddress AS baddress','business_information.website_url', 'business_information.radius_address','business_information.radius','products.productname AS productname', 'products.price','products.productdescription','users.first_name','users.last_name','users.email','users.phone','users.address')
                            ->get();   
            return view('admin.orderview')->with('orderdetail',$orderdetail);
            foreach($orderdetail as $order)
            {
                $orderid  = $order->ordernumber;
            }   
            $id = [
                'id' => $orderid,
            ];

            $data = [
                'title' => 'Order Invoice',
                'date' => date('m/d/Y'),
                'orderdetail' => $orderdetail
            ];
            

            $pdf = PDF::loadView('admin.orderview', $data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream('Order#'.$id["id"].'.pdf');

    }

public function invoice(){
    return view('admin.orderview');
}
}

