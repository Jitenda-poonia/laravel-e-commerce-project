<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function store(Request $request) {
        // echo "test";

        if(!Auth::user() == null) {
            $data = $request->all();
            // dd($data);
            if(Wishlist::where('user_id', $request->user_id)->where('product_id', $request->product_id)->exists()) {
                Wishlist::where('user_id', $request->user_id)->where('product_id', $request->product_id)->delete();
                return redirect()->back();
            } else {
                Wishlist::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id
                ]);
                return redirect()->back()->with('success', 'Product added to wishlist.');
            }
        }

        return redirect()->route('customer.login');


       
    }



    public function destroy($productId) {
        // echo $productId;
        $userId = Auth::user()->id;
        $wishlist = Wishlist::where('product_id', $productId)->where('user_id', $userId)->delete();

        return redirect()->back()->with('success', "Item removed from wishlist.");
        
    }

    

}
