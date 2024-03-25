<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("category_index"), 403);

        return view('admin.category.index', ['categories' => Category::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("category_create"), 403);
        $products = Product::all();
       return view('admin.category.create',compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();

        $ctgryPrnt = $data['category_parent_id'];
        $data['category_parent_id'] = $ctgryPrnt ? $ctgryPrnt : 0;

        $urlKey = $data['url_key'] ? $data['url_key'] : $data['name'];
        $data['url_key'] = categoryUniqueUrlKey($urlKey);
        $data['name'] = ucwords( $data['name']);
        $category =   Category::create($data);
        if($request->hasFile('image') && $request->File('image')){
            $category->addMediaFromRequest('image')->toMediaCollection('image');
          
          };
        $category->products()->sync($request->input('products'));
        if ($request->save) {
            return redirect()->route('category.index')->with('success', 'Data Save Successfully');

        } else {
            return back()->with('success', 'Data Save Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('category_show'), 403);
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('category_edit'), 403);


        $category = Category::findOrFail($id);
        $products = Product::all();
        return view('admin.category.edit', compact('category','products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $ctgryPrnt = $data['category_parent_id'];
        $data['category_parent_id'] = $ctgryPrnt ? $ctgryPrnt : 0;
        $data['name'] = ucwords( $data['name']);

        $category = Category::findOrFail($id);
        $category->update($data);

        if($request->hasFile('image')){
            $category->clearMediaCollection('image');
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        
            }
        if($request->has('products')){
            $category->products()->sync($request->input('products'));
        }
        return redirect()->route('category.index')->with('success', 'Data Update Successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('category_parent_id', $id)->delete();
        Category::where('id', $id)->delete();
        return back()->with('success', 'Data Delete Successfully');
    }
}
