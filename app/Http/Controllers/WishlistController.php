<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function addToWishlist($product_id)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('customer.login')->with('error', 'yor are login to add to product wishlist');
        }

        $prrms = [
            'user_id' => $user->id,
            'product_id' => $product_id
        ];
        $wishlist = Wishlist::where($prrms);
        if ($wishlist->count() > 0) {
            $wishlist->delete();

        } else {
            Wishlist::create($prrms);
        }
        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    public function removeFromWishlist($id)
    {
        Wishlist::where('id', $id)->delete();
        return redirect()->back()->with('success', "Item removed from wishlist.");
    }
}
