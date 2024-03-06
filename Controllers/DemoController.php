<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index(){
        $array=[[
            'name'=>'sumit',
            'email'=>'sharmaJi@gmail.com'
    
        ],[
            'name'=>'rajji',
            'email'=>'raji@gmail.com'
        ]];

        return response()->json([
            'message'=>'found results',
            'data'=>$array,
            'status'=>true
        ],200);
    }
}
