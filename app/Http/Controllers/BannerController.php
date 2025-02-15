<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Admin;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        return view('admin.banners')->with('admin', $admin);
    }

    public function getBanners()
    {
        $banners = Banner::select('banner_id as id', 'title', 'description', 'image_path', 'video_path', 'status')->get();
        return response()->json($banners);
    }

    public function createBanner(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'image_path' => 'nullable|mimes:jpg,jpeg,png',
            'video_path' => 'nullable|mimes:mp4,mkv'
        ]);

        try {
            $banner = new Banner();
            $banner->title = $req->title;
            $banner->description = $req->description;
            $banner->status = "1";
            
            if ($req->hasFile('image_path')) {
                $banner->image_path = $req->file('image_path')->store('banners', 'public');
            }
            if ($req->hasFile('video_path')) {
                $banner->video_path = $req->file('video_path')->store('videos', 'public');
            }

            $banner->save();
            return response()->json(['success' => 'Banner added successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function updateBanner(Request $req, $id)
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

    public function deleteBanner($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            Storage::delete([$banner->image_path, $banner->video_path]);
            $banner->delete();
            return response()->json(['success' => 'Banner deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
