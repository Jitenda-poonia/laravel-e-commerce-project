<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Gate;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("manage_permission"), 403);

        $permissions = Permission::orderBy('name')->get();
        // dd($permissions);
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("manage_permission"), 403);

        return view("admin.permission.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = $request->validate([
            'name' => 'required | unique:permissions'
        ]);
        
        Permission::create($permission);
      if($request->save){
       return redirect()->route('permission.index')->with('success','permission add successfully');
      }else{
        return back()->with('success','permission Save Successfully');
      }

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
        abort_unless(Gate::allows("manage_permission"), 403);

        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = $request->validate([
            'name'=>'required|unique:permissions,name,'.$id
            ]);
       $per = Permission::where('id',$id)->update($permission);
    //    dd($per);
    return redirect()->route('permission.index')->with('success','Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::where('id',$id)->delete();
        return redirect()->route('permission.index')->with('success','data delete successfully');

    }
}
