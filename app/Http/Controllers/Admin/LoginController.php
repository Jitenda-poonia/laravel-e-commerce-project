<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLog;

class LoginController extends Controller
{
    public function index()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            // If the user is authenticated, redirect them to the dashboard
            return redirect()->route('dashboard');
        }

        // If the user is not authenticated, show the login page
        return view('admin.login.index');
    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($loginData)) {

            // Create user log for admin
            $userId =  Auth::user()->id;
            UserLog::create(['user_id' =>$userId ]);

            //return only the latest & second-to-last login recors
            returnLatestTwoLogins($userId);
            return redirect()->route('dashboard')->with('success', 'User Login Successfully');
        } else {
            return redirect()->route('login')->with('error', 'Email and Password not valid, please try again');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
}



