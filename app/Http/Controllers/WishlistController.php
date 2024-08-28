<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function addToWishlist($product_id)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('customer.login')->with('error', 'yor are login to add to product wishlist');
        }

        $params = [
            'user_id' => $user->id,
            'product_id' => $product_id
        ];
        // Retrieve the wishlist item if it exists
        $wishlist = Wishlist::where($params)->first();

        if ($wishlist) {
            // If it exists, delete it
            $wishlist->delete();
        } else {
              Wishlist::create($params);

        }
        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    public function removeFromWishlist($id)
    {
        Wishlist::where('id', $id)->delete();
        return redirect()->back()->with('success', "Item removed from wishlist.");
    }
}
