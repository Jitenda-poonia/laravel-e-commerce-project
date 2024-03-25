<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
class ManageCustomerController extends Controller
{
    public function index(){
        abort_unless(Gate::allows('manage_customer'), 403);

        // $users = User::where('is_admin',0)->get();
        $users = User::all();
        return view('admin.customer.index',compact('users'));
    }


    public function show($id){
        abort_unless(Gate::allows('manage_customer'), 403);

        $user = User::where('id',$id)->first();
        $orders = Order::where('user_id',$user->id)->get();
        return view('admin.customer.show',compact('user','orders'));
    }
}
