<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Portfolio;
use App\Models\Partner;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function banners()
    {
        $banners = Banner::all();
        if($banners->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$banners], 200);
        }
        
    }
    public function portfolios()
    {
        $portfolios = DB::table('portfolios as p')
                        ->join('portfolio_categories as pc', 'p.portfolio_category_id', '=', 'pc.portfolio_category_id')
                        ->select('p.portfolio_id', 'p.title', 'p.image_path', 'p.description', 'p.status', 'pc.title as category_title')
                        ->get();
        if($portfolios->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$portfolios], 200);
        }
    }
    public function portfolioCategories()
    {
        $pc = PortfolioCategory::all();
        if($pc->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$pc], 200);
        }
    }
    public function partners()
    {
        $partners = Partner::all();
        if($partners->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$partners], 200);
        }
    }
}
