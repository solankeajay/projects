<?php

namespace App\Http\Controllers\Sanctum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students|max:50',
            'password' => 'required|confirmed',
        ];
        $request->validate($rules);

        Student::create(
            array('name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'phone_no' => isset($request->phone_no) ? $request->phone_no : '')
        );

        return response()->json([
            "status" => 1,
            "message" => 'Student added sucssesfuly.'
        ]);
    }

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email|max:50',
            'password' => 'required',
        ];
        $request->validate($rules);     
        
        $student = Student::where("email","=",$request->email)->first();

        if(isset($student->id)){

            if(Hash::check($request->password,$student->password)){

                $token = $student->createToken("auth_token")->plainTextToken;

                return response()->json([
                    "status" => 1,
                    "message" => 'student login successfully',
                    "access_token" => $token
                ]);

            }else{
                return response()->json([
                    "status" => 0,
                    "message" => 'password Not match.'
                ],404);
            }

        }else{
            return response()->json([
                "status" => 0,
                "message" => 'Student Not Found.'
            ],404);
        }

    }

    public function profile(Request $request)
    {
        return response()->json([
            "status" => 1,
            "message" => "Student Profile information",
            "data" => auth()->user()
        ]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => 1,
            "message" => "student logout successfully"
        ]);
    }
}
