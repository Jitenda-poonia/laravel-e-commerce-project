<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Gate;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('page_index'),403);
        $pages = Page::orderBy("id", "desc")->get();
        return view("admin.page.index", compact("pages"));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        abort_unless(Gate::allows("page_create"), 403);

        $pages = Page::all("id", "title");
        return view("admin.page.create", compact("pages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required",
            "heading" => "required",
            "ordering" => "required|numeric",
            "status" => "required",
            "description" => "required",
            "image" => "required",
        ]);
        $urlKey = $request->url_key ? $request->url_key : $data['title'] ;
        $data['url_key'] = generateUniqueUrlKey($urlKey);

        $data['title'] = ucwords($data['title']);

        $prntId = $request->parent_id;
        $data['parent_id'] = $prntId ? $prntId : 0;
         
        $page = Page::create($data);
        $page->addMediaFromRequest('image')->toMediaCollection('image');
        return redirect()->route('page.index')->with('success','Data Save Successfully');
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
        abort_unless(Gate::allows("page_edit"), 403);

        $page = Page::findOrFail($id);
        $pages = Page::all();
        // dd($page); 
        return view('admin.page.edit', compact('page', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            "title" => "required",
            "heading" => "required", 
            "ordering" => "required|numeric",
            "status" => "required",
            "description" => "required",
            
        ]);
        
      
        $data['title'] = ucwords($data['title']);
        $prntId = $request->parent_id;
        $data['parent_id'] = $prntId ? $prntId : 0;

        $page = Page::findOrFail($id);
        $page->update($data);

        if ($request->hasFile('image')) {
            $page->clearMediaCollection('image');
            $page->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('page.index')->with('success', 'Data Upadate Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        $data = $page->getFirstMediaUrl('id');
        return redirect()->route('page.index')->with('success', 'Record Delete Successfully');
    }
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
