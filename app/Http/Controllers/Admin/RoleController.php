<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;  
use Spatie\Permission\Models\Permission;
use Gate;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("manage_role"), 403);
        $roles = Role::all();
        return view("admin.role.index", compact("roles"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("manage_role"), 403);

        $permissions = Permission::select('name')->get();
       return view("admin.role.create" , compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $role = Role::create([
            'name'=> ucfirst($request->name)
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('role.index')->with('success','Data Add Successfully');

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
        abort_unless(Gate::allows("manage_role"), 403);
        
        $role = Role::findOrFail($id);
        $slctdPrmsn = $role->Permissions->pluck('name')->toArray();
        $permissions = Permission::select('name')->get();
        return view('admin.role.edit', compact('role','slctdPrmsn','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $role = Role::findOrFail($id);
        $role->update([
            'name'=> ucfirst($request->name)
        ]);
        if($request->has('permissions')){
            $role->syncPermissions($request->permissions);
        };
        return redirect()->route('role.index')->with('success','Data update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();
        return redirect()->route('role.index')->with('success','Data Delelte Successfully');


    }
}
