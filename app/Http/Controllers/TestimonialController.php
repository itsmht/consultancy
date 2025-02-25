<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use App\Models\Admin;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function testimonials()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $testimonials = Testimonial::all();
        return view('admin.testimonials')->with('admin', $admin)->with('testimonials', $testimonials);
    }
    public function createTestimonial(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $req->validate([
            'client_name' => 'required',
            'designation' => 'required',
            'rating' => 'required',
            'image_path' => 'required|mimes:jpg,jpeg,png',
        ]);

        try {
            $testimonial = new Testimonial();
            $testimonial->client_name = $req->client_name;
            $testimonial->designation = $req->designation;
            $testimonial->rating = $req->rating;
            $testimonial->company = $req->company;
            $testimonial->description = $req->description;
            $name_without_space = str_replace(' ', '-', $req->name);
            $testimonial->status = "1";
            
            if ($req->hasFile('image_path')) {
                $url = url('')."/testimonial_images";
                $file = $req->image_path;
                $file_name1 = $url . "/" . $name_without_space. "-".$admin->admin_phone . "-" . time() ."." . $file->getClientOriginalExtension();
                $file->move(public_path('testimonial_images'), $file_name1);
                $testimonial->image_path = $file_name1;
            }
            $testimonial->save();
            return back()->with('success', 'New Testimonial Added');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
