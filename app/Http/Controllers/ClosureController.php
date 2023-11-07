<?php

namespace App\Http\Controllers;
use App\Models\Closure;

use Illuminate\Http\Request;

class ClosureController extends Controller
{
    public function check_closure(Request $request)
    {
        if($request->ajax())
        {
        $output="true";
        $closure = Closure::where('closure_id','=',$request->search)->exists();
        if($closure)
        {
        return Response('closure found');
        }else{
            return Response('closure not found');
        }
        }
    }

}
