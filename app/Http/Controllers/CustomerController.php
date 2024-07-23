<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function create()
    {
        return view('web.customer.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required |unique:users|email',
            'password' => 'required',


        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)


        ]);

        // Send email
        Mail::to($request->email)->send(new RegisterEmail($user));
        return redirect()->route('customer.login')->with('success', 'User account created successfully.');

    }

    public function custemerLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('web.customer.login');
    }


    // User login
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            getActivateCart(getAuthUserId());
            return redirect()->route('home')->with('success', 'User login successfully.');
        } else {
            return redirect()->back()->with('error', "Your login details do not match our records. Please check and try again.");
        }
    }


    public function logout(Request $request)
    {
        Session::forget('cart_id');
        Auth::logout();
        return redirect()->route('home');

    }

    public function profile()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $wishlistItems = Wishlist::where('user_id', $userId)->get();

            $orders = Order::where('user_id', $userId)->get();
            $billingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'billing')->first();
            $shippingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'shipping')->first();
            return view('web.customer.profile', compact('orders', 'billingAddress', 'shippingAddress', 'wishlistItems'));
        } else {
            return redirect()->route('customer.login');
        }
    }


    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required'
        ]);

        $auth = Auth::user();

        if (!Hash::check($request->current_password, $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }
        if (!strcmp($request->current_password, $request->password)) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
        $user = User::find($auth->id);
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', "Your details have been updated successfully.");

    }

    public function customerProductShow($id)
    {
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
       return view('web.customer.order-produts',compact('order','billingAddress','shippingAddress','orderItems'));

    }

}



