<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ProductTrait;
use App\Models\BusinessInformation;

class PackageController extends Controller
{   
    use ProductTrait;

    public function index()
    {   
        $radius = BusinessInformation::where('client_id',Auth()->User()->id)->get();
        foreach($radius as $rad)
        {
            $radius_value = $rad->radius;
        }
        $data = $this->show_products($radius_value);
        return view('packages')->with('data',$data);
    }
}
