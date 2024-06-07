<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
<<<<<<< HEAD
use Illuminate\Support\Facades\Gate;
=======
use Gate;
>>>>>>> origin/main

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("slider_index"), 403);

        $sliders = Slider::all();
        return view("admin.slider.index", compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
<<<<<<< HEAD

=======
    
>>>>>>> origin/main
    {
        abort_unless(Gate::allows("slider_create"), 403);

        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required",
            "ordering" => "required",
            "status" => "required",
            "image" => "required",
        ]);
<<<<<<< HEAD
=======

        $slider = Slider::create($data);
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $slider->addMediaFromRequest('image')->toMediaCollection('image');

        }
        
        return redirect()->route('slider.index')->with("success", "Record Save Successfullay");
>>>>>>> origin/main

        $slider = Slider::create($data);
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $slider->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('slider.index')->with("success", "Record Save Successfullay");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
=======

>>>>>>> origin/main
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows("slider_edit"), 403);

        $slider = Slider::find($id);
        return view("admin.slider.edit", compact("slider"));
<<<<<<< HEAD
=======

>>>>>>> origin/main
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            "title" => "required",
            "ordering" => "required",
            "status" => "required",
        ]);
        $slider = Slider::findOrFail($id);
        $slider->update($data);
        if ($request->hasFile('image')) {
            $slider->clearMediaCollection('image');
            $slider->addMediaFromRequest('image')->toMediaCollection('image');
            // ya
            // $slider->addMedia($request->file('image'))->toMediaCollection('image');
        }
        if ($request->remove) {
            $slider->clearMediaCollection('image');
<<<<<<< HEAD
        }
        return redirect()->route('slider.index')->with("success", "Record Update Successfullay");
=======

        }
        return redirect()->route('slider.index')->with("success", "Record Update Successfullay");

>>>>>>> origin/main
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        $slider->getFirstMediaUrl('id');
        return redirect()->route('slider.index')->with("success", "Record Delete Successfullay");
<<<<<<< HEAD
=======

>>>>>>> origin/main
    }
}
