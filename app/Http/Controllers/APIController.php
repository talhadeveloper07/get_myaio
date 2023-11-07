<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class APIController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json(["users" => $users], 200);        
    }
    public function business_information(){
        $business_info = BusinessInformation::where('business_information.client_id',Auth()->User()->id)
        ->join('users','users.id','=','business_information.client_id')
        ->join('orders','orders.client_id','=','business_information.client_id')
        ->join('products','products.id','=','business_information.pid')
        ->get();
    }
}
