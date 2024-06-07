<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_admin', 0)->get();
        return response()->json($users);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = user::create($data);
        return response()->json(['status' => true, 'data' => $user]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->update($data);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = User::findOrFail($id);
        // print_r($data);
        // die;
        $user = $data->delete();    //user table me Deleted column(soft delete) hone ke karn delete nhi hoga
        return response()->json($user);
    }
}
