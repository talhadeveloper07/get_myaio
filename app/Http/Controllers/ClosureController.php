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
        $closure = Closer::where('id','=',$request->search)->exists();
        if($closure)
        {
        return Response('closer found');
        }else{
            return Response('closer not found');
        }
        }
    }

}
