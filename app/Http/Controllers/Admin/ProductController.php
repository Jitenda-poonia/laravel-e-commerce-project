<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Gate;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("product_index"), 403);

        return view('admin.product.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("product_create"), 403);
        $categories = Category::all();
        $relatedProducts = Product::all();

        return view('admin.product.create', compact('categories', 'relatedProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'sku' => 'required|unique:products',
            'qty' => 'required',
            'stock_status' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'description' => 'required',

        ], [
            'status.required' => 'Please select status',
            'is_featured.required' => 'Please select featured',
            'sku.required' => 'Stock keeping unit field is required',
            'qty.required' => 'Quantity is required',
            'stock_status.required' => 'Please select stock status',
        ]);
        $data = $request->all();


        $data['related_product'] = implode(', ', $data['related_product'] ?? ['No']);
        $urlKey = $data['url_key'] ?? $data['name'];
        $data['url_key'] = productUniqueUrlKey($urlKey);
        $data['name'] = ucwords($data['name']);

        //Data insert Products table
        $product = Product::create($data);

        // get prodect Id
        $productId = $product->id;

        $attributesId = $request->input('attributes');
        $attributeValuesId = $request->input('attribute_values');


        foreach ($attributesId as $attributeId) {

            foreach ($attributeValuesId[$attributeId] as $attributeValueId) {

                //Data insert product_attributes table

                ProductAttribute::create([
                    'product_id' => $productId,
                    'attribute_id' => $attributeId,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }

        //images insert media table

        if ($request->hasFile('image') && $images = $request->file('image')) {
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('image');
            }
        }
        if ($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()) {
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        // product and category  relationship insert to Product_catogries table
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }



        if ($request->save) {
            return redirect()->route('product.index')->with('success', 'Data Save Successfully');
        } else {
            return back()->with('success', 'Data Save Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows("product_show"), 403);
        $product =  Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $relatedProducts = Product::all();
        $productAttributes = ProductAttribute::where('product_id', $id)->get();
        // dd($productAttributes);
        return view('admin.product.edit', compact('product', 'categories', 'relatedProducts', 'productAttributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'sku' => 'required|unique:products,sku,' . $id,
            'qty' => 'required',
            'stock_status' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'related_product' => 'nullable|array',

        ], [
            'status.required' => 'Please select status',
            'is_featured.required' => 'Please select featured',
            'sku.required' => 'Stock keeping unit field is required',
            'qty.required' => 'Quantity is required',
            'stock_status.required' => 'Please select stock status',
        ]);
        $data = $request->all();

        $data['related_product'] = implode(', ', $data['related_product'] ?? []);
        $data['name'] = ucwords($data['name']);

        $product = Product::findOrFail($id);
        $product->update($data);

        // Delete existing ProductAttribute records for the product
        ProductAttribute::where('product_id', $product->id)->delete();

        $attributesId = $request->input('attributes');
        $attributeValuesId = $request->input('attribute_values');


        foreach ($attributesId as $attributeId) {

            foreach ($attributeValuesId[$attributeId] ?? [] as $attributeValueId) {

                ProductAttribute::create([
                    'product_id' => $id,
                    'attribute_id' => $attributeId,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }
        if ($request->hasFile('image') && $images = $request->file('image')) {
            foreach ($images as $image) {
                $product->addMedia($image)->toMediaCollection('image');
            }
        }
        if ($request->hasFile('thumbnail_image') && $request->File('thumbnail_image')->isValid()) {
            $product->clearMediaCollection('thumbnail_image');
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        return redirect()->route('product.index')->with('success', 'Data Update Successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

    }

}
