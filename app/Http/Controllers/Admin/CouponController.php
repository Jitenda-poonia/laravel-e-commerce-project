<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Gate;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        abort_unless(Gate::allows('manage_coupon'), 403);
        $coupons = Coupon::all();
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('manage_coupon'), 403);

        return view('admin.coupon.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'status' => 'required',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date',
            'discount_amount' => 'required|numeric',
        ]);

        Coupon::create($request->all());
        return redirect()->route('coupon.index')->with('success','Data save Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('manage_coupon'), 403);

        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required|unique:coupons,coupon_code,'.$id,
            'status' => 'required',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date',
            'discount_amount' => 'required|numeric',
        ]);
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());
        return redirect()->route('coupon.index')->with('success','Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::where('id',$id)->delete();
        return redirect()->route('coupon.index')->with('success','Data Delete Successfully');

    }
}
