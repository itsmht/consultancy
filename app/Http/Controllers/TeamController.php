<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Admin;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function teams()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $teams = Team::where('status', '1')->get();
        return view('admin.teams')->with('admin', $admin)->with('teams', $teams);
    }
    public function createTeam(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $req->validate([
            'name' => 'required',
            'designation' => 'required',
            'video_path' => 'required|mimes:mp4,mkv,mov,avi,flv,wmv',
        ]);

        try {
            $team = new Team();
            $team->name = $req->name;
            $name_without_space = str_replace(' ', '-', $req->name);
            $team->designation = $req->designation;
            $team->status = "1";
            if ($req->hasFile('video_path')) {
                $url = url('')."/team_videos";
                $file = $req->video_path;
                $file_name2 = $url . "/" . $name_without_space. "-".$admin->admin_phone . "-" . time() ."." . $file->getClientOriginalExtension();
                $file->move(public_path('team_videos'), $file_name2);
                $team->video_path = $file_name2;
            }
            $team->save();
            return back()->with('success', 'New Team Message Added');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
