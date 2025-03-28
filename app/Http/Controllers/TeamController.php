<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Hackathone;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json([
            'status' => 'success',
            'teams' => $teams,
        ]);
    }


    public function show(Request $request){
        $team = Team::find($request['id']);

        return response()->json([
            'message' => 'Team found successfully',
            'Team' => $team,
        ]);
    }

    public function create(Request $request){

        $hackathon = Hackathone::where('title', $request['hackathon'])->first();

        $user = User::find(Auth::user()->id);
        $team = new Team();
        $team->name = $request['name'];
        $team->score = 0;
        $team->comment = "no comment yet";
        $team->hackathone()->associate($hackathon);
        $team->status = "Pending";  
        // return $team;
        $team->save();
        


        return response()->json([
            'message' => 'Team created successfully',
            'Team' => $team,
        ]);
    }

    public function update(Request $request){
        $team = Team::find($request['id']);
        $team->update($request->all());

        $hackathon = DB::table('hackathones')->where('title', $request['hackathon'])->first();

        $team->score = $request->score;
        $team->comment = $request->comment;
        $team->status = $request->status;
        $team->save();

            return response()->json([
                'message' => 'Team updated successfully',
                'Team' => $team
            ]);
    }

    public function delete(Request $request){
        $team = Team::find($request['id']);
        $team->delete();

        return response()->json([
            'message' => 'Team deleted successefully',
            'Team' => $team,
        ]);
    }

    public function joinAteam(Request $request){
        $team = DB::table('teams')->where('name' , $request['team_name'])->first();
        
        // if(){
            
        // }
        //update team_id
        $user = Auth()->user();
        $role = Role::find($user->role_id);
        return response()->json([
            'user' => $user,
            'role' => $role
        ]);
        dd();
        $user->team_id = $team->id;

        $user->save();
    }

    
    
}
