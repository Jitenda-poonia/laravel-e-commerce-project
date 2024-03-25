<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Product;
use App\Models\QuoteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $attributeValue = json_encode(($request->attribute_value ?? []));
        $product = Product::find($productId);
        $price = getProductPrice($productId);

        $cartItem = $request->cart_item;
        $cart_id = Session::get('cart_id');
       
        if (!$cart_id) {
            $cart_id = Str::uuid()->toString();
            Session::put('cart_id', $cart_id);
        }
    
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
                'product_id' => $productId,
                'name' => $product->name, 
                'sku' => $product->sku,
                'price' => $product->price,
                'qty' => $cartItem,
                 'custom_option' => $attributeValue,
            ]);
        }
        return back();
    }
}
