<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::all();

        return response()->json([
            'project' => $project
        ]);
    }

    public function show(Request $request)
    {
        $project = Project::find($request['id']);

        return response()->json([
            'massage' => 'Project found successfully',
            'project' => $project
        ]);
    }

    public function create(Request $request)
    {
        // $hackathon = DB::table('hackathones')->where('title', $request['hackathon'])->first();

        $team = DB::table('teams')->where('name', $request['team_name'])->first();

        // return response()->json([
        //     'team' => $team
        // ]);
        // dd();

        $project = Project::create([
            'name' => $request['name'],
            'subject' => $request['subject'],
            'description' => $request['description'],
            'assessment_id' => 1,
            'team_id' => $team->id
        ]);

        return response()->json([
            'message' => 'Project created seccessfully',
            'Project' => $project
        ]);
    }

    public function update(Request $request)
    {

        $project = Project::find($request['id']);
        $project->update($request->all());

        return response()->json([
            'message' => 'Project updated successfully',
            'Project' => $project
        ]);
    }


    public function delete(Request $request)
    {
        $project = Project::find($request['id']);
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully',
            'Project' => $project
        ]);
    }
}
