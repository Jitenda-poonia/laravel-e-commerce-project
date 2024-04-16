<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Block;

//HomeController
class HomeController extends Controller
{
    public function index()
    {

        $sliders = Slider::where("status", 1)->get();
        return view("web.home", compact('sliders'));
    }
    public function contact()
    {
        return view('web.contact');
    }
    //get page.blade.php me 
    public function page($urlkey)
    {
        // $pages = Page::where('url_key', $urlkey)->where('status', 1)->first() ? Page::where('url_key', $urlkey)->where('status', 1)->first() : Block::where('identifier', $urlkey)->where('status', 1)->first();
        $pages = Page::where('url_key', $urlkey)->where('status', 1)->first();
        if ($pages) {
            return view('web.page', compact('pages'));
        } else {
            abort(404);
        }
        
    }


    public function category(Request $request, $url_key)
    {
        // Full URL
        $fullUrl = URL::full();

        // dd(explode('-', $request->price));
        // Retrieve the category based on the provided URL key
        $category = Category::where('url_key', $url_key)->first();

        // Start building the product query based on the category
        $query = $category->products();


        // $category = Category::with(['products' => function ($query) use ($request) {
        // Extracted price range from the request
        // Convert string values to integers
        // Apply filters based on the request parameters
        if ($request->has('price')) {
            $priceExp = explode('-', $request->price);
            $priceExp[0] = (int) $priceExp[0];
            $priceExp[1] = (int) $priceExp[1];
            //  dd($priceExp);
            $query->whereBetween('products.price', $priceExp);
        }

        if ($request->has('sorting') && $request->sorting == 'latest') {
            $query->orderBy('id', 'desc');
        } elseif ($request->has('sorting') && $request->sorting == 'low_to_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->has('sorting') && $request->sorting == 'high_to_low') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->paginate(3);
        // }])->where('url_key', $url_key)->first();

        // echo "<pre>";
        // print_r($category->products);
        // die;
        // //$products = $category->products()->paginate(9);

        if ($category) {
            return view('web.category', compact('category', 'products', 'request', 'fullUrl'));
        } else {
            abort(403);
        }
    }
    public function product($urlkey)
    {
        $product = Product::where('url_key', $urlkey)->where('status', 1)->first();

        $productAttributes = ProductAttribute::where('product_id', $product->id)->get();
        $attributes = [];
        foreach ($productAttributes as $productAttribute) {
            $attributeId = $productAttribute->attribute_id;
            $attributeValueId = $productAttribute->attribute_value_id;
            $attribute = Attribute::find($attributeId);
            $attributeValue = AttributeValue::find($attributeValueId);

            if ($attribute && $attributeValue) {
                if (!isset($attributes[$attribute->name])) {
                    $attributes[$attribute->name] = [];
                }
                $attributes[$attribute->name][] = $attributeValue;

            }
        }

        return view('web.product', compact('product', 'attributes'));
    }

    
}
