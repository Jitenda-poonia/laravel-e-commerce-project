<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;

class LoginController extends Controller
{
    public function index()
    {
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
            UserLog::create(['user_id' => Auth::user()->id]);

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
