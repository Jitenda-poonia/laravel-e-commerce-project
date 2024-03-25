<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Gate;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows("user_index"), 403);
        $users = User::where('is_admin',1)->get();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows("user_create"), 403);
        $roles = Role::select('name')->get();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required |unique:users|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'roles' => 'required',
             
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Bcrypt($request->password),
            'roles' => $request->roles,
            'is_admin' => 1,
            'designation' => $request->designation
        ]);
        if($request->hasFile('image') && $request->File('image')->isValid()){
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        };
        $user->syncRoles($request->input('roles'));
        return redirect()->route('user.index')->with('success','Your details Save Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user =  User::findOrFail($id);
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows("user_edit"), 403);
        $user = User::findOrFail($id);
        $roles = Role::select('name')->get();
        $slctRole = $user->Roles->pluck('name')->toArray();
        return view('admin.user.edit',compact('user','roles','slctRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!($request->password)) {
           $data = $request->validate([
            'name' => 'required',
            'roles' => 'required',

            ]);
           $user = User::where('id',$id)->update([
            "name" => $data["name"],
           'designation' =>$request->designation
           ]);
        } else {
            $data = $request->validate([
                "name" => "required",
               
                "password" => "required|min:3",
                "confirm_password" => "required|min:3|same:password",
                 'roles' => 'required',
                
            ]);
           $user = User::where('id',$id)->update([
            "name" => $data["name"],
            
            "password" => bcrypt($data["password"]),
            'designation' =>$request->designation

           ]);
            
        }
        
        $user = User::findOrFail($id);
        
        if($request->hasFile('image')){
            $user->clearMediaCollection('image');
            $user->addMediaFromRequest('image')->toMediaCollection('image');
         
            }
        $user->syncRoles($request->roles);
        return redirect()->route("user.index")->with("success", "your details update Successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        user::where('id',$id)->delete();
        return redirect()->route("user.index")->with("success", "user delete Successfully");

    }
}
