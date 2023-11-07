<?php

namespace App\Http\Controllers;
use App\Models\BusinessInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessInformationController extends Controller
{

    public function business_info_radius(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bname'=>'required',
        ]);

        if ($validator->fails()){
            return redirect('/add-business-details')->with('error','please fill all fields.');
        }
        $name = [$request->bname];
        $phone = [$request->bphone];
        $email = [$request->bemail];
        $address = [$request->baddress];
        $website = [$request->website_url];
        $working_hours = [$request->working_hours];
        $description = [$request->description];

        return view('addradius')->with([
        'name'=>$name,
        'phone'=>$phone,
        'email'=>$email,
        'address'=>$address,
        'website_url'=>$website,
        'description'=>$description
    ]);
    }

    public function business_info_insert(Request $request)
    {
        // dd($request->self_closure);
        $data = [  
            'client_id' => $request->client_id,    
            'bname'=> $request->bname,     
            'bemail'=> $request->bemail,
            'bphone' => $request->bphone,
            'website_url'=> $request->website_url,
            'baddress' => $request->baddress,
            'description'=> $request->description,
            'radius_address'=> $request->radius_address,
            'radius' => $request->radius,
            'closer_name' => $request->self_closure 
        ];
        BusinessInformation::create($data);
        return redirect('select-package')->with('message',"your business information is addedd successfully");
    }

    public function updatebusiness()
    {
        $data = BusinessInformation::where('client_id', Auth()->User()->id)->get();
        return view('editbusiness')->with('data',$data);
    }

    public function business_info_update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bname'=>'required',
        ]);

        if ($validator->fails()){
            return redirect('/edit-business-details')->with('error','please fill all fields.');
        }
        $name = [$request->bname];
        $phone = [$request->bphone];
        $email = [$request->bemail];
        $address = [$request->baddress];
        $website = [$request->website_url];
        $working_hours = [$request->working_hours];
        $description = [$request->description];
        $radiusaddress = [$request->radiusaddress];
        $radius = [$request->radius];

        return view('editradius')->with([
        'name'=>$name,
        'phone'=>$phone,
        'email'=>$email,
        'address'=>$address,
        'website_url'=>$website,
        'description'=>$description,
        'radiusaddress' => $radiusaddress,
        'radius' => $radius
    ]);
    }

    public function business_update(Request $request)
    {
        $business = BusinessInformation::where('client_id',$request->client_id)
                                        ->update([
                                            'bname' => $request->bname,
                                            'bemail' => $request->bemail,
                                            'bphone' => $request->bphone,
                                            'website_url' => $request->website_url,
                                            'baddress' => $request->baddress,
                                            'description' => $request->description,
                                            'radius_address' => $request->radius_address,
                                            'radius' => $request->radius
                                        ]);

        return redirect('select-package')->with('message',"your business information is addedd successfully");
    }
}
