<?php

namespace App\Http\Controllers\Sanctum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
        ];
        $request->validate($rules);

        $student_id = auth()->user()->id;

        Project::create(
            array('student_id'=>$student_id,'name' => $request->name, 'description' => $request->description, 'duration' => $request->duration)
        );

        return response()->json([
            "status" => 1,
            "message" => 'Project created sucssesfuly.'
        ]);
    }

    public function list()
    {
        $student_id = auth()->user()->id;

        $project = Project::where("student_id",$student_id)->get();

        return response()->json([
            "status" => 1,
            "message" => 'Projects',
            "data" => $project
        ]);
    }

    public function single($id)
    {
        $student_id = auth()->user()->id;
        if (Project::where(["id" => $id,"student_id"=>$student_id])->exists()) {

            $details = Project::where(["id" => $id, "student_id" => $student_id])->first();

            return response()->json([
                "status" => 1,
                "message" => "project details.",
                "data" => $details
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "project not found."
            ], 404);
        }
    }

    public function delete($id)
    {
        $student_id = auth()->user()->id;
        if (Project::where(["id" => $id, "student_id" => $student_id])->exists()) {

            $project = Project::where(["id" => $id, "student_id" => $student_id])->first();

            $project->delete();

            return response()->json([
                "status" => 1,
                "message" => "project deleted sucssesfuly."
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "project not found."
            ], 404);
        }
    }
}
