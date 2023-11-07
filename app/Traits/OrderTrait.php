<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\BusinessInformation;
use App\Models\Product;

trait OrderTrait{

    public function get_order_invoice()
    {
        $business_info = BusinessInformation::where('business_information.client_id',Auth()->User()->id)
        ->join('users','users.id','=','business_information.client_id')
        ->join('orders','orders.client_id','=','business_information.client_id')
        ->join('products','products.id','=','business_information.pid')
        ->get();
        return $business_info;
    }

    public function get_single_product($productid)
    {
        $product = Product::where('id',$productid)->get();
        return $product;
    }

}