<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('attribute_index'), 403);
        $attributes = Attribute::all();
        return view('admin.attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('attribute_create'), 403);
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_variant' => 'required',
            'atrName.0' => 'required',
            'atrStatus.0' => 'required',
        ], [
            'is_variant.required' => 'please select variant',
            'atrName.0.required' => 'Attribute value name is required',
            'atrStatus.0.required' => 'Attribute value status is required'
        ]);

        $data = $request->all();
        $nameKey = $data['name_key'] ?? $data['name'];
        $data['name_key'] = attrNameKey($nameKey);

        $attribute = Attribute::create($data);

        $attributeValueNames = $request->atrName;
        $attributeValueStatuses = $request->atrStatus;

        foreach ($attributeValueNames as $key => $name) {
            $status = $attributeValueStatuses[$key];
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'name' => $name,
                'status' => $status
            ]);
        }

        return redirect()->route('attribute.index')->with('success', 'Data Save Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('attribute_show'), 403);
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('attribute_edit'), 403);
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_variant' => 'required',
            'atrName.0' => 'required',
            'atrStatus.0' => 'required',
        ], [
            'is_variant.required' => 'please select variant',
            'atrName.0.required' => 'Attribute value name is required',
            'atrStatus.0.required' => 'Attribute value status is required'
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->update([
            'name' => $request->name,
            'status' => $request->status,
            'is_variant' => $request->is_variant,
        ]);

        $attributeValueIds = $request->atrvalueId;
        $attributeValueNames = $request->atrName;
        $attributeValueStatuses = $request->atrStatus;

        if (empty($attributeValueIds)) {
            AttributeValue::where('attribute_id', $id)->delete();
        } else {
            AttributeValue::whereNotIn('id', $attributeValueIds)->where('attribute_id', $id)->delete();
        }

        foreach ($attributeValueNames as $key => $name) {
            $attributeValueId = $attributeValueIds[$key] ?? 0;

            if ($attributeValueId) {
                AttributeValue::where('id', $attributeValueId)->update([
                    'name' => $name,
                    'status' => $attributeValueStatuses[$key]
                ]);
            } else {
                AttributeValue::create([
                    'attribute_id' => $id,
                    'name' => $name,
                    'status' => $attributeValueStatuses[$key]
                ]);
            }
        }

        return redirect()->route('attribute.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AttributeValue::where('attribute_id', $id)->delete();
        Attribute::where('id', $id)->delete();
        return redirect()->route('attribute.index')->with('success', 'Data Delete Successfully');
    }
}
