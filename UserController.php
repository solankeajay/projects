<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) 
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|min:5|max:20'
            ]);

            $match = $request->only('email','password');

            if(Auth::attempt($match)){

                return redirect('dashboard')->with('succsess','Login succsesfully.');

            }else{

                return redirect()->back()->with('error', 'email or password are not match.');

            }

        }

        return view('login');

    }

    public function register(Request $request)
    {
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users,email|max:100',
                'password' => 'required|min:5|max:20',
                'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            ]);

            // $imageName = md5(time()) . '.' . $request->image->extension();

            // $request->file('image')->storeAs('user_img',$imageName,'public');
            $imageName = $request->file('image')->store('user_img','public');

            $imageName = pathinfo($imageName, PATHINFO_BASENAME);

            if(!empty($imageName)){

                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make( $request->password),
                    'image' => $imageName,
                ]);

            }
            
            return redirect('login')->with('succsess','You are registred sucssfully');
        }

        return view('register');
    }

    public function logout()
    {
        // return true;

        Auth::logout();
        return redirect('login');
    }
}
