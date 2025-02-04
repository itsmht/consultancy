<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function banners()
    {
        $banners = Banner::all();
        return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$banners], 200);
    }
}
