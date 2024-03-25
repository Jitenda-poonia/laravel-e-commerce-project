<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $attributeValue = json_encode(($request->attribute_value ?? []));
        $cartItem = $request->cart_item;

        $product = Product::find($productId);
        $price = getProductPrice($productId);

        $cart_id = Session::get('cart_id');

         // Get the authenticated user
          $user = Auth::user();

        if ($cart_id) {
            // echo $cart_id . 'Update time';

            // Session::forget('cart_id');

            $quote = Quote::firstOrCreate(['cart_id' => $cart_id]);
            $quoteId = $quote->id;


            $quoteItem = QuoteItem::where('quote_id', $quoteId)->where('product_id', $productId)->first();

            if ($quoteItem) {
                // If the item already exists, update the quantity
                $quoteItem->update([
                    'qty' => $cartItem + $quoteItem->qty,

                ]);
            } else {
                // If the item doesn't exist, create a new one
                QuoteItem::create([
                    'quote_id' => $quoteId,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $price,
                    'product_id' => $productId,
                    'custom_option' => $attributeValue,
                    'qty' => $cartItem,
                ]);
            }
        } else {
            $cart_id = Str::uuid()->toString();
            Session::put('cart_id', $cart_id);
            // echo $cart_id . "First time";

         
            $quote = Quote::create([
                'cart_id' => $cart_id,
                'user_id' => $user->id ?? 0,
                'name' => $user->name ?? null,
                'email' => $user->email ?? null,
            ]);

            QuoteItem::create([
                'quote_id' => $quote->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $price,
                'product_id' => $productId,
                'custom_option' => $attributeValue,
                'qty' => $cartItem,
            ]);
        }

        recalculateCart();

        return redirect()->route('cart');
        
    }



    // View Cart method
    public function viewCart()
    {
        $cartId = Session::get('cart_id');
        $quote = Quote::where('cart_id', $cartId)->first();
        return view('web.viewcart', compact('quote'));

    }

    // cart delete method
    public function cartDelete(Request $request, $id)
    {
        QuoteItem::where('id', $id)->delete();
        recalculateCart();
        return redirect()->back();
    }


    // apply coupon method
    public function couponApply(Request $request, $quoteId)
    {

        // dd($request->all());

        $couponCode = $request->coupon;
        $cartId = Session::get('cart_id');
        $quote = Quote::where('cart_id', $cartId)->first();
        if ($request->get('action') == 'apply_coupon') {

            $coupon = Coupon::where('coupon_code', $couponCode)->where('status', 1)->first();
            // dd($coupon);
            // $quote = Quote::where('id', $quoteId)->first();
            // dd($quote);
            if ($coupon) { 
                if (($coupon->valid_from <= now()) && ($coupon->valid_to >= now()) && $coupon->discount_amount < $quote->subtotal) {
                    $quote = Quote::where('id', $quoteId)->update([
                        'coupon' => $coupon->coupon_code,
                        'coupon_discount' => $coupon->discount_amount
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Coupon is not valid .');
                }
                recalculateCart();
                return redirect()->back()->with('success', 'Coupon Applied successfully.');
            } else {
                return redirect()->back()->with('error', 'Coupon Not Applicable.');

            }

        } else {
            Quote::where('id', $quoteId)->update([
                'coupon' => NULL,
                'coupon_discount' => 0.00
            ]);
            recalculateCart();
            return redirect()->back()->with('success', 'Coupon removed successfully');
        }

    }

    public function cartUpdate(Request $request, $id)
    {
        // dd($request->all());
        $quoteItem = QuoteItem::find($id);
      
        $qty = $request->qty;
        $rowTotal = $quoteItem->price * $qty;
      QuoteItem::where('id', $id)->update([
            'qty' => $qty,
            'row_total' => $rowTotal,
        ]);
        
        recalculateCart();
        return redirect()->back();
        

    }

}
