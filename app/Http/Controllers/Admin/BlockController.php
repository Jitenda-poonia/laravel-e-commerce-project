<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Gate;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("block_index"), 403);

        $blocks = Block::all();
        return view('admin.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("block_create"), 403);

        return view('admin.block.create');

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
        $identifier = $request->identifier ? $request->identifier : $data['title'];
        $data['identifier'] = generateUniqueidentifier($identifier);

        $data['title'] = ucwords($data['title']);

        $block = Block::create($data);
        if ($request->hasFile('image')) {
            $block->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->route('block.index')->with('success', 'Data Save Successfully');
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
        abort_unless(Gate::allows("block_edit"), 403);

        $block = Block::findOrFail($id);
        return view('admin.block.edit', compact('block'));

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

        $block = Block::findOrFail($id);
        $block->update($data);
        if ($request->hasFile('image')) {
            $block->clearMediaCollection('image');
            $block->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->route('block.index')->with('success', 'Data Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $block = Block::findOrFail($id);
        $block->delete();
        $block->getFirstMediaUrl('id');
        return redirect()->route('block.index')->with('success', 'Record Delete Successfully');
    }
}
