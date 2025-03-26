<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Testing\Assert;

class AssessmentController extends Controller
{
    public function index(){
        $assessments = Assessment::all();

        return response()->json([
            'status' => 'success',
            'Assessment' => $assessments
        ]);
    }



    public function show(Request $request){
        $assessment = Assessment::find($request['id']);

        return response()->json([
            'message' => 'assessment found successfully',
            'assessment' => $assessment
        ]);
    }



    public function create(Request $request){

        $evaluator = DB::table('users')->where('name', $request['evaluator'])->first();


        $assessment = Assessment::create([
            'comment' => $request['comment'],
            'user_id' => $evaluator->id
        ]);

        return response()->json([
            'message' => 'Assessment created successfully',
            'Assessment' => $assessment
        ]);
    }

    public function update(Request $request){
        $assessment = Assessment::find($request['id']);
        $assessment->update($request->all());

        return response()->json([
            'message' => 'Assaessment updated successfully',
            'assessment' => $assessment
        ]);
    }

    public function delete(Request $request){
        $assessment = Assessment::find($request['id']);
        $assessment->delete();

        return response()->json([
            'message' => 'Assessment deleted successfully',
            'assessment' => $assessment
        ]);
    }


}
