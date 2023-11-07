<?php

namespace App\Http\Controllers;
use App\Models\Closer;

use Illuminate\Http\Request;

class ClosureController extends Controller
{
    public function check_closure(Request $request)
    {
        if($request->ajax())
        {
        $output="true";
        $closer = Closer::where('id','=',$request->search)->get();
        if($closer->isNotEmpty())
        {
            foreach($closer as $close)
        return Response($close->name);
        }else{
            return Response('closer not found');
        }
        }
    }

}
