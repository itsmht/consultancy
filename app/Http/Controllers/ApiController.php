<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Portfolio;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\ContactForm;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    // public function portfolios()
    // {
    //     $portfolios = DB::table('portfolios as p')
    //                     ->join('portfolio_categories as pc', 'p.portfolio_category_id', '=', 'pc.portfolio_category_id')
    //                     ->select('p.portfolio_id', 'p.title', 'p.image_path', 'p.description', 'p.status', 'pc.title as category_title')
    //                     ->get();
    //     if($portfolios->isEmpty()){
    //         return response()->json(['code'=>'404','message'=>'No data found'], 404);
    //     }
    //     else
    //     {
    //         return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$portfolios], 200);
    //     }
    // }
    // public function portfolioCategories()
    // {
    //     $pc = PortfolioCategory::all();
    //     if($pc->isEmpty()){
    //         return response()->json(['code'=>'404','message'=>'No data found'], 404);
    //     }
    //     else
    //     {
    //         return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$pc], 200);
    //     }
    // }
    public function portfolios()
{
    $portfolios = DB::table('portfolios as p')
                    ->join('portfolio_categories as pc', 'p.portfolio_category_id', '=', 'pc.portfolio_category_id')
                    ->select('p.portfolio_id', 'p.title', 'p.image_path', 'p.description', 'p.status', 'pc.portfolio_category_id', 'pc.title as category_title','pc.slug')
                    ->get();

    if ($portfolios->isEmpty()) {
        return response()->json(['code' => '404', 'message' => 'No data found'], 404);
    }

    // Group portfolios by category
    $categorizedPortfolios = $portfolios->groupBy('portfolio_category_id')->map(function ($items, $categoryId) {
        return [
            'category_id' => $categoryId,
            'category_title' => $items->first()->category_title,
            'category_slug' => $items->first()->slug,
            'portfolios' => $items->map(function ($item) {
                return [
                    'portfolio_id' => $item->portfolio_id,
                    'title' => $item->title,
                    'image_path' => $item->image_path,
                    'description' => $item->description,
                    'status' => $item->status,
                ];
            })->values()
        ];
    })->values(); // Reset keys

    return response()->json([
        'code' => '200',
        'message' => 'Request Successful',
        'data' => $categorizedPortfolios
    ], 200);
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
    public function testimonials()
    {
        $testimonials = Testimonial::select('testimonial_id','client_name','designation','description','company','rating','video_path','image_path')->get();
        if($testimonials->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$testimonials], 200);
        }
    }
    public function teamMessages()
    {
        $team = Team::select('team_id','name','designation','video_path')->get();
        if($team->isEmpty()){
            return response()->json(['code'=>'404','message'=>'No data found'], 404);
        }
        else
        {
            return response()->json(['code'=>'200','message'=>'Request Successful','data'=>$team], 200);
        }
    }
    public function storeContact(Request $req)
    {
        $validator = Validator::make($req->all(),
            [
            'name' => "required|max:60|min:3|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",
            'phone' => "required",
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'meeting_time' => 'required',
            ],
            [
            'name.required' => 'Name is required',
            'name.max' => 'Maximum 20 characters allowed',
            'name.min' => 'Minimum 6 characters allowed',
            'name.regex' => 'Not a valid name',
            'phone.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'email.email' => 'Not a valid email',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
            'meeting_time.required' => 'Meeting time is required',
            ]);
        if ($validator->fails())
        {
            return response()->json(['code'=>'401','message'=>'Validation error.','data'=>$validator->errors()], 401);
        }
        else
        {
            try
            {
                $contact = new ContactForm();
                $contact->name = $req->name;
                $contact->phone = $req->phone;
                $contact->email = $req->email;
                $contact->subject = $req->subject;
                $contact->message = $req->message;
                $contact->meeting_time = $req->meeting_time;
                $contact->status = '1';
                $contact->save();
                return response()->json(['code'=>'200','message'=>'Contact form submitted successfully'], 200);
            }
            catch(\Exception $e)
            {
                return response()->json(['code'=>'500','message'=>'Internal server error','data'=>$e->getMessage()], 500);
            }
        }
    }
}
