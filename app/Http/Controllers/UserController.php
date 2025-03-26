<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){
        $user = User::all();

        return response()->json([
            'user' => $user
        ]);
    }

    public function show(Request $request){
        $user = User::find($request['id']);

        return response()->json([
            'message' => 'user found successfully',
            'user' => $user
        ]);
    }

    public function create(Request $request){
        // hackathon = DB::table('hackathones')->where('title', $request['hackathon'])->first();
        $role = DB::table('roles')->where('name' , $request['role'])->first();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => Hash::make($request->password),
            'image' => 'image.png',
            'role_id' => $role->id
        ]);
        
        return response()->json([
            'message' => 'user created successfully',
            'user' => $user
        ]);
    }

    public function update(Request $request){

        $user = User::find($request['id']);

        $role = DB::table('roles')->where('name' , $request['role'])->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $role->id;
        $user->save();
        // $user->update($request->all());

        return response()->json([
            'message' => 'user updated successfully',
            'user' => $user
        ]);
    }

    public function delete(Request $request){
        $user = User::find($request['id']);
        $user->delete();

        return response()->json([
            'message' => 'user updated successfully',
            'user' => $user
        ]);
    }
}
