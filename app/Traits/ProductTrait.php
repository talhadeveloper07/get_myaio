<?php

namespace App\Traits;

use App\Models\Product;

trait ProductTrait{

    public function show_products($radius_value){

        if($radius_value >= 10 && $radius_value <= 30)
        {
            $products = Product::where('radius','=','30')->get();
            return $products;
        }
        elseif($radius_value >= 30 && $radius_value <= 50)
        {
            $products = Product::where('radius','=','50')->get();
            return $products;
        }
        elseif($radius_value >= 50 && $radius_value <= 70)
        {
            $products = Product::where('radius','=','70')->get();
            return $products;
        }
        elseif($radius_value >= 50 && $radius_value < 100)
        {
            $products = Product::where('radius','=','100')->get();
            return $products;
        }
    }
}