<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            // $studentM = new Student();
            
            $request->validate([
                'email' => 'required|max:100',
                'password' => 'required|max:20',
            ]);

            $match = $request->only('email', 'password');

            if (Auth::attempt($match)) {
                
                $user_id = Auth::user()->id;
                $email = Auth::user()->email;
                $position = Auth::user()->position;
                
                Session::put('user',['id'=> $user_id,'email'=>$email, 'position'=>$position]);

                $request->session()->regenerate();

                return redirect()->intended('Dashboard');
                
            }else{
                return back()->withErrors('Username Or Password Not Found.');
            }

        }else{

            return view('login');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('Login');

    }
}
