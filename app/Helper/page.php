<?php

use App\Models\Attribute;
use App\Models\Block;
use App\Models\Page;
use App\Models\Category;
use App\Models\Product;
use App\Models\Enquiry;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function getPages()
{
    return Page::orderBy('ordering')->active()->where('parent_id', 0)->get();
}

function getSubPages($id)
{
    return Page::oderBy('ordering')->active()->where('parent_id', $id)->get();
}

//category create/edit ke liye start
function categories()
{
    return Category::where('category_parent_id', 0)->get();
}

function SubCategories($id)
{
    return Category::where('category_parent_id', $id)->get();
}

function subsubCategories($id)
{
    return  Category::where('category_parent_id', $id)->get();
}
//category create/edit ke liye end

function enquiryCount()
{
    return Enquiry::active()->count();

}

//show file me Category ka name show ke liye
function subCategoryName($id)
{
    $category = Category::where('id', $id)->first();
    return $category->name ?? 'No parent category';
}

//fornted category ke liye
function frntcategories()
{
    return  Category::where('category_parent_id', 0)->active()->where('show_in_menu', 1)->with('media')->get();

}
function frntSubCategories($id)
{
    return Category::where('category_parent_id', $id)->active()->where('show_in_menu', 1)->with('media')->get();

}

function products()
{
    return Product::where('is_featured', 1)->active()->with('media')->get();
}
function block($identifier)
{
    return Block::active()->where('identifier', $identifier)->with('media')->first();
}

//Home page pr limited category show
function mostCategories()
{
    return Category::active()->orderBy('id', 'DESC')->limit(15)->with('media')->get();
}
function featuredProducts()
{
    return Product::where('is_featured', 1)->limit(15)->get();

}
// getting related product
function getRelatedProducts($ids)
{
    $ids = explode(', ', $ids);
    return Product::whereIn('id', $ids)->get();

}
// add last products
function recentProducts()
{
    return Product::orderBy('id', 'DESC')->active()->with('media')->limit(8)->get();

}
function getAttribute()
{
    return Attribute::all();

}

function getProductPrice($pId)
{
    $todayDate = now();
    $product = Product::find($pId);
    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
}
//CartItem count
function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return ($quote->items ?? 0) ? $quote->items->count() : 0;
    } else {
        return 0;
    }
}
function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();

    //data get from relationship //QuoteItem load where Quote_id
    $items = $quote->items;
    // dd($items);
    foreach ($items as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
    }

    $quote->subtotal = $quote->items->sum('row_total');
    // dd($quote->subtotal);

    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon = null;
        $quote->coupon_discount = 0.00;
    }
    $quote->save();
}
// get product image for viewcart page

function productImage($pId)
{
    return Product::find($pId)->getFirstMediaUrl('thumbnail_image');
}

function getProductPriceShow($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate) && ($product->special_price)) {

        ?>
        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
            <?= $product->special_price ?>
        </h3>
        <h4 class="font-weight-semi-bold mb-4"><del>
                <?= $product->price ?>
            </del></h4>
        <?php

    } else {

        ?>
        <h4 class="font-weight-semi-bold mb-4">
            <?= $product->price ?>
        </h4>
        <?php
    }
    return;
}

// wishlist count
function wishlistCount()
{
    // Use the authenticated user to get the wishlist count
    $user = auth()->user();
    return $user?->wishlist->count()?:0;

}


// get Auth User Id
function getAuthUserId()
{
    return Auth::user()->id?:0;
}

/**
 * Activate the cart for the specified user.

 */
function getActivateCart($userId)
{
    // Get the current cart ID from the session
    $cartId = Session::get('cart_id');

    // Update the quote with the user ID
    $quote = Quote::where('cart_id', $cartId)->update(['user_id' => $userId]);

    // Check if there is a cart ID(logout hone ke bad aad to cart kren pr carcurrent cart ID)
    if ($cartId) {
        // Find any existing quotes associated with the user and a different cart
        $quoteOld = Quote::where('user_id', $userId)->where('cart_id', '!=', $cartId)->first();

        // If there is an existing quote, merge its items with the current cart
        if ($quoteOld) {
            $newQuote = Quote::where('cart_id', $cartId)->first();
            $quoteId = $newQuote->id ?? 0;

            // Update the quote ID for the items in the existing quote
            QuoteItem::where('quote_id', $quoteOld->id)->update(['quote_id' => $quoteId]);

            // Delete the existing quote
            $quoteOld->delete();
        }
    } else {
        // If there is no cart ID, retrieve the quote associated with the user(logut hone ke bad bina addto cart kre login hone pr phle wale caritem show ke liye)
        $quote = Quote::where('user_id', $userId)->first();
        // dd($quote);
        // If a quote is found, set its cart ID to the session
        if ($quote) {
            $cartId = $quote->cart_id;
            Session::put('cart_id', $cartId);
        }
    }
}

/**
 * Get price ranges for a given category.

 */
function getProductPriceFilter($categoryId)
{
    // Retrieve the category with its associated products
    $category = Category::with('products')->where('id', $categoryId)->first();

    // Find the minimum and maximum prices among the products
    $minPrice = $category->products->min('price');
    $maxPrice = $category->products->max('price');

    // Define the price interval
    $interval = 3000;

    // Generate and return the price ranges
    return generatePriceRanges($category->products, $minPrice, $maxPrice, $interval);
}

/**
 * Generate price ranges based on product prices.

 */
function generatePriceRanges($products, $minPrice, $maxPrice, $interval)
{
    $ranges = [];

    // Calculate the number of intervals needed
    $numIntervals = ceil(($maxPrice - $minPrice + 1) / $interval);

    // Loop through intervals to generate ranges
    for ($i = 0; $i < $numIntervals; $i++) {
        // Determine start and end prices for the current interval
        $startPrice = $minPrice + ($i * $interval);
        $endPrice = ($startPrice + $interval - 1);

        // Count the number of products within the current price range
        $productCount = $products->where('price', '>=', $startPrice)
            ->where('price', '<=', $endPrice)
            ->count();

        // Store the range information in the result array
        $ranges[] = [
            'start' => $startPrice,
            'end' => $endPrice,
            'count' => $productCount,
        ];
    }

    return $ranges;
}
