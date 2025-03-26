<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index(){
        $role = Role::all();

        return response()->json([
            'roles' => $role
        ]);
    }


    public function show(Request $request){
        $role = Role::find($request['id']);

        return response()->json([
            'message' => 'role found seccessflly',
            'role' => $role
        ]);
    }



    public function create(Request $request){

       $role =  Role::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'role created successfully',
            'role' => $role,
        ], 200);
    }


    public function update(Request $request){
        // $role = Role::find($request['id']);

        $role = DB::table('roles')->where('name' , $request['role'])->first();

        $role->update($request->all());

        return response()->json([
            'message' => 'role updates successflly',
            'role' => $role
        ]);
    }


    public function delete(Request $request){
        $role = Role::find($request['id']);
        $role->delete();

        return response()->json([
            'message' => 'role deleted successflly',
            'role' => $role
        ]);
    }
}
