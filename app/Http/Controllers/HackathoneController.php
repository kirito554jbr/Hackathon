<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Hackathone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Builder;

class HackathoneController extends Controller
{

    public function index(){
        $hackathon = Hackathone::all();

        return response()->json([
            'Hackathon' => $hackathon,
        ]);
    }


    public function show(Request $request){
        $hackathon = Hackathone::find($request['id']);

        return response()->json([
            'Hackathon' => $hackathon,
        ]);
    }

    public function create(Request $request){
        $hackathon = Hackathone::create([
            'title'=> $request['title'],
            'start_date' => $request['start_date'],
            'expiration_date' => $request['expiration_date'],
            'status' => $request['status'],
            'roles' => $request['roles'],
            'edition' => $request['edition'],
            'subject' => $request['subject']
        ]);

        return response()->json([
            'Hackathon' => $hackathon,
        ]);
    }

    public function update(Request $request, $id){


        $hackathon = Hackathone::find($id);
        $hackathon->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Hackathon updated successfully',
            'hackathon' => $hackathon,
        ]);
    }


    public function delete(Request $request){
        $hackathon = Hackathone::find($request['id']);
        $hackathon->delete();

        return response()->json([
            'message' => 'Hackathon deleted successfully',
            'hackathon' => $hackathon,
        ]);
    }


    public function inscription(Request $request){
        $user = Auth()->user();
        
        $hackathon = DB::table('hackathones')->where('title' , $request['hackathon'])->first();

        $user->hackathone_id = $hackathon->id;

        $user->save();
    }
}
