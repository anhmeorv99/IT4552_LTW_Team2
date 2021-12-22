<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    /**
     * Create a new controller instance.
*
*
     * @return void
     */
    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->email;
        return response()->json(['success'=> $input]);
        // if ($input->email == "test@gmail.com"){
        //     return response()->json(['success'=>'Got Simple Ajax Request.']);
        // }
        // else return response()->json(['fail'=>'OK']);
    }

}
