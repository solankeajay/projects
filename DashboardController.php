<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('dashboard',['users' => $users]);
    }

    public function ShowUpdateUser($id)
    {
        $user = User::find($id);

        if(empty($user)){
            return redirect()->back();
        }

        return view('edit',compact('user'));
    }

    public function updateUser(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'uid' => 'required|integer',
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users,email,' . $request->uid . '|max:100',
                'image' => ['image', 'mimes:jpg,jpeg,png'],
            ]);

            $user = User::find($request->uid);

            if (!empty($user)) {

                if(!empty($request->image)){

                    Storage::disk('public')->delete('user_img/' . $user->image);

                    // $imageName = md5(time()) . '.' . $request->image->extension();

                    // $request->file('image')->storeAs('user_img',$imageName,'public');
                    $imageName = $request->file('image')->store('user_img', 'public');

                    $imageName = pathinfo($imageName, PATHINFO_BASENAME);

                }

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];

                if(isset($imageName)){
                    $data['image'] = $imageName;
                }

                $user->fill($data);
                $user->save($data);


                return redirect('dashboard')->with('succsess', 'User Updated sucssfully');

            }else{

                return redirect()->back();

            }

            // return true;

            return redirect('login')->with('succsess', 'You are registred sucssfully');
        }
        
    }

    public function deleteUser($id)
    {

        $user = User::find($id);

        if (!empty($user)) {

            Storage::disk('public')->delete('user_img/' . $user->image);

            $user->delete();

            return redirect('dashboard')->with('succsess', 'User Deleted sucssfully');
        }else{

            return redirect()->back();
            
        }


    }
}
