<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function login()
    {
        return view('auth.login');
    }
    function loginSubmit(Request $req)
    {
        $req->validate(
            [
                'admin_phone' => 'required',
                'admin_password' => 'required',
            ],
            [
                'admin_phone.required' => 'Please Enter Your Phone Number',
                //'email.email' => 'Please Enter A Valid Email Address',
                'admin_password.required' => 'Please Enter Your Password',
            ]

        ); //Validating User Authentication Information
        $user = Admin::where('admin_phone', $req->admin_phone)->where('admin_password',$req->admin_password)->first(); //Authentication
        if($user)
        {
            if($user->status=="1")//Checking If User Status is Active
            {
                session()->put('logged', $user->admin_phone);
                return redirect()->route('adminDashboard');
            }
            else
            {
                return redirect()->route("login")->with('message','Your account is not approved yet!');
            }
        }
        else
        {
            return redirect()->route("login")->with('message','The credentials does not match!');
        }
    }
    function logout()
    {
        session()->forget('logged'); //Session destroyed
        session()->flash('msg','Sucessfully Logged out');
        return redirect()->route('login');
    }
    function dashboard()
    {   $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        return view('admin.dashboard')->with('admin', $admin);
    }
}
