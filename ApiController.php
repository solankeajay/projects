<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function index()
    {

        $users = User::get();

        return $this->sendResponse($users,'All Users Detsils.');
        
    }

    public function registr(Request $request)
    {

        try{
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users,email|max:100',
                'password' => 'required|min:5|max:20',
                'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            ]);

            // $imageName = md5(time()) . '.' . $request->image->extension();

            // $request->file('image')->storeAs('user_img',$imageName,'public');
            $imageName = $request->file('image')->store('user_img', 'public');

            $imageName = pathinfo($imageName, PATHINFO_BASENAME);

            if (!empty($imageName)) {

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'image' => $imageName,
                ]);

                $response['name'] = $user->name;
                $response['token'] = $user->createToken('register')->plainTextToken;
            }

            return $this->sendResponse($response, 'User Create sucssfully.');

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|min:5|max:20'
            ]);

            $match = $request->only('email', 'password');

            if (Auth::attempt($match)) {

                $user = Auth::user();

                $response['name'] = $user->name;
                $response['token'] = $user->createToken('login')->plainTextToken;

                return $this->sendResponse($response, 'Login sucssfully');
            } else {

                // return redirect()->back()->with('error', 'email or password are not match.');

                return $this->sendError('Unauthorised', 'email or password are not match.');
            }
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function update(Request $request)
    {
        try{

            $request->validate([
                'uid' => 'required|integer',
                'name' => 'max:100',
                'email' => 'email|unique:users,email,' . $request->uid . '|max:100',
                'image' => ['image', 'mimes:jpg,jpeg,png'],
            ]);

            $user = User::find($request->uid);

            if (!empty($user)) {

                if (!empty($request->image)) {

                    Storage::disk('public')->delete('user_img/' . $user->image);

                    // $imageName = md5(time()) . '.' . $request->image->extension();

                    // $request->file('image')->storeAs('user_img',$imageName,'public');
                    $imageName = $request->file('image')->store('user_img', 'public');

                    $imageName = pathinfo($imageName, PATHINFO_BASENAME);
                }

                $data = [
                    'name' => !empty($request->name) ? $request->name : $user->name,
                    'email' => !empty($request->email) ? $request->email : $user->email,
                ];

                if (isset($imageName)) {
                    $data['image'] = $imageName;
                }

                $user->fill($data);
                $user->save($data);

                return $this->sendResponse($user, 'User Updated sucssfully');
                // return redirect('dashboard')->with('succsess', 'User Updated sucssfully');
            } else {

                return $this->sendError("Unauthorised",'User not Found.');
            }
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if(!empty($user)){

            Storage::disk('public')->delete('user_img/' . $user->image);

            $user->delete();

            return $this->sendResponse([], 'User Deleted sucssfully');
        }else{

            return $this->sendError('Unauthorised','User Not Found');

        }

       
    }

    public function downloadFile($filename)
    {
        $filePath = 'user_img/'. $filename;

        if (Storage::disk('public')->exists($filePath)) {

            // Determine the file's MIME type.
            $mimeType = Storage::mimeType($filePath);

            $headers = [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            // Download the file
            return Storage::disk('public')->download($filePath, $filename, $headers);
        } else {
            // If the file does not exist, return a 404 response.
            return response()->json(['error' => 'File not found'], 404);
        }

    }




}
