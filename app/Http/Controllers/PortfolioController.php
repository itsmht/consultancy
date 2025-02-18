<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Admin;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function portfolios()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $portfolios = Partner::all();
        return view('admin.portfolios')->with('admin', $admin)->with('portfolios', $portfolios);
    }
    public function portfolioCategories()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $categories = PortfolioCategory::all();
        return view('admin.categories')->with('admin', $admin)->with('categories', $categories);
    }

    public function createPortfolio(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $req->validate([
            'title' => 'required',
            'image_path' => 'required|mimes:jpg,jpeg,png',
        ]);

        try {
            $partner = new Partner();
            $partner->title = $req->title;
            $title_without_space = str_replace(' ', '-', $req->title);
            $partner->status = "1";
            
            if ($req->hasFile('image_path')) {
                $url = url('')."/public/partner_images";
                $file = $req->image_path;
                $file_name1 = $url . "/" . $title_without_space. "-".$admin->admin_phone . "-" . time() ."." . $file->getClientOriginalExtension();
                $file->move(public_path('partner_images'), $file_name1);
                $partner->image_path = $file_name1;
            }
            $partner->save();
            return back()->with('success', 'New Partner Added');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function createPortfolioCategory(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $req->validate([
            'title' => 'required',
        ]);

        try {
            $portfolio = new PortfolioCategory();
            $portfolio->title = $req->title;
            $portfolio->status = "1";
            $portfolio->save();
            return back()->with('success', 'New Portfolio Category Added');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updatePartner(Request $req, $id)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $banner = Banner::findOrFail($id);
            $banner->title = $req->title;
            $banner->description = $req->description;
            $banner->status = $req->status;

            if ($req->hasFile('image_path')) {
                Storage::delete($banner->image_path);
                $banner->image_path = $req->file('image_path')->store('banners', 'public');
            }
            if ($req->hasFile('video_path')) {
                Storage::delete($banner->video_path);
                $banner->video_path = $req->file('video_path')->store('videos', 'public');
            }

            $banner->save();
            return response()->json(['success' => 'Banner updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
