<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simple;
use Illuminate\Support\Facades\Validator;

class simpleController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:simples|max:50',
            'phone_no' => 'required',
            'gander' => 'required'
        ];
        $request->validate($rules);

        Simple::create(
            array('name' => $request->name,'email' => $request->email,'phone_no' => $request->phone_no, 'gander' => $request->gander)
        );

        return response()->json([
            "status" => 1,
            "message" => 'User added sucssesfuly.' 
        ]);

    }
    public function select()
    {
        $data = Simple::get();

        return response()->json([
            "status"=>1,
            "message"=>"show data",
            "data"=>$data
        ]);
    }
    public function singleSelect($id)
    {
        if(Simple::where("id",$id)->exists()){

            $data = Simple::where("id", $id)->first();

            return response()->json([
                "status" => 1,
                "message" => "user found.",
                "data"=> $data
            ]);

        }else{
            return response()->json([
                "status" => 0,
                "message" => "user not found."
            ],404);
        }

    }
    public function update(Request $request, $id)
    {
        if (Simple::where("id", $id)->exists()) {

            $user = Simple::find($id);

            $user->update(
                array('name' => !empty($request->name) ? $request->name : $user->name, 'email' => !empty($request->email) ? $request->email : $user->email, 'phone_no' => !empty($request->phone_no) ? $request->phone_no : $user->phone_no, 'gander' => !empty($request->gander) ? $request->gander : $user->gander)
            );

            return response()->json([
                "status" => 1,
                "message" => 'User Updated sucssesfuly.'
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "user not found."
            ], 404);
        }
    }
    public function delete($id)
    {
        if (Simple::where("id", $id)->exists()) {

            $data = Simple::find($id);

            $data->delete();

            return response()->json([
                "status" => 1,
                "message" => "user Deleted."
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "user not found."
            ], 404);
        }
    }
}
