<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Gate;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('attribute_index'), 403);
        return view('admin.attribute.index', ['attributes' => Attribute::all()]);

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
        ],[
            'is_variant.required' =>'please select variant',
            'atrName.0.required' => 'Attribute value  name is required',
            'atrStatus.0.required' => 'Attribute value status is required'
        ]);
        $data = $request->all();

        $nameKey = $data['name_key'];
        $name = $data['name'];
        $nameKey = $nameKey ? $nameKey : $name;
        $data['name_key'] = attrNameKey($nameKey);

        $atrData = Attribute::create($data);

        $atrVluNames = $request->atrName;
        $atrVluStatus = $request->atrStatus;
        foreach ($atrVluNames as $key => $name) {
            $status = $atrVluStatus[$key];
            AttributeValue::create([
                'attribute_id' => $atrData->id,
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
        $attribute = Attribute::find($id);
        return view('admin.attribute.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        return view('admin.attribute.edit', ['attribute' => Attribute::findOrFail($id)]);
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
        ],[
            'is_variant.required' =>'please select variant',
            'atrName.0.required' => 'Attribute value  name is required',
            'atrStatus.0.required' => 'Attribute value status is required'
        ]);
      
         Attribute::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'is_variant' => $request->is_variant,
        ]);
        $atrValueId = $request->atrvalueId;
        // dd($atrValueId);
        $atrValueNames = $request->atrName;
        $atrValueStatus = $request->atrStatus;
        if (empty($atrValueId)) {
            AttributeValue::where('attribute_id', $atrValueId)->delete();
        } else {
            AttributeValue::whereNotIn('id', $atrValueId)->where('attribute_id', $id)->delete();

        }
        if ($atrValueNames) {
            foreach ($atrValueNames as $key => $name) {
                $atrValue_Id = $atrValueId[$key] ?? 0;
        
                if ($atrValue_Id) {
                    AttributeValue::where('id', $atrValue_Id)->update([
                        'name' => $name,
                        'status' => $atrValueStatus[$key]
                    ]);
                } else {
                    AttributeValue::create([
                        'attribute_id' => $id,
                        'name' => $name,
                        'status' => $atrValueStatus[$key]

                    ]);
                }

            }
        }



        return redirect()->route('attribute.index')->with('success', 'Data update Successfully');

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
