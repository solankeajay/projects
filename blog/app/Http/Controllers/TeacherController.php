<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TeacherDetails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    public function index(Request $request, $value = '')
    {
        $value = Request()->all();

        $row = 10;

        if(isset($value['sort'])){
            if($value['sort'] == 'Date'){

                $teacher = TeacherDetails::orderBy('DOB','ASC')->paginate($row);
            } 
        }elseif(isset($value['search'])){
            $teacher = TeacherDetails::where('f_name','LIKE','%'. $value['search'].'%')->orWhere('l_name', 'LIKE', '%' . $value['search'] . '%')->orWhere('address', 'LIKE', '%' . $value['search'] . '%')->paginate($row);
        }else{

            $teacher = DB::table('teacher_details')->paginate($row);
        }

        $route = Route::currentRouteName();
        $sort_by = ['Birth Date' => 'Date'];
        return view("teacher.index", ['teacher' => $teacher, 'route' => $route,'sort_by'=>$sort_by]);
    }

    public function insert(Request $request)
    {
        if ($request->isMethod('post')) {

            // $studentM = new Student();

            $user_id = $request->session()->get('id');

            $rules = [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',

                'address' => 'required|string|min:3|max:255',
                'email' => 'required|string|email|unique:users,email|max:50',
                'password' => 'required|digits between:8,16',
                'mobile_number' => 'required|digits between:10,13|unique:student,mobile_number',
                'category' => 'required|string|max:50',
                'teacher_img' => ['required', 'image', 'mimes:jpg,jpeg,png']
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

                // $data = $request->input();

                $imageName = time() . '.' . $request->teacher_img->extension();

                $request->teacher_img->move(public_path('images'), $imageName);


                // $insert = DB::table('student')->insert(
                //     array( 'f_name' => $data['fname'],'l_name'=> $data['lname'], 'father_name'=> $data['father_name'], 'gander' => $data['gander'],'email' => $data['email'], 'address'=> $data['address'], 'DOB'=> $data['dob'], 'mobile_number'=> $data['mobile_number'] ,'category' => $data['category'],'class'=> $data['class'],'student_image'=> $imageName)
                // );
                $insert = TeacherDetails::create(
                    array('f_name' => $request->fname, 'l_name' => $request->lname, 'father_name' => $request->father_name, 'gander' => $request->gander, 'email' => $request->email, 'password' => Hash::make($request->password), 'address' => $request->address, 'DOB' => $request->dob, 'mobile_number' => $request->mobile_number, 'category' => $request->category,'photo' => $imageName)
                );
                DB::table('users')->insert(array('email' => $request->email, 'password' => Hash::make($request->password), 'position' => 'Teacher'));


                if (!empty($insert)) {
                    return redirect('TeacherData')->with('message', 'Teacher Added successfuly');
                }
            }
        }
        return view("teacher.insert");
    }

    public function edit($id)
    {
        $teacher = TeacherDetails::find($id);

        return view("teacher.update", ['teacher' => $teacher]);
    }
    public function update(Request $request)
    {

        if ($request->isMethod('post')) {

            $rules = [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',

                'address' => 'required|string|min:3|max:255',
                'email' => 'required|string|email|unique:teacher_details,email,'.$request->id.'|unique:student,email|max:50',
                'mobile_number' => 'required|digits between:10,13|unique:student,mobile_number,' . $request->id . '',
                'category' => 'required|string|max:50',
            ];
            if (!empty($request->newimg)) {
                $rules['newimg'] = ['required', 'image', 'mimes:jpg,jpeg,png'];
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

                // $data = $request->input();
                if (!empty($request->newimg)) {
                    unlink("images/" . $request->old_image);
                    $imageName = time() . '.' . $request->newimg->extension();
                    $request->newimg->move(public_path('images'), $imageName);
                } else {
                    $imageName = $request->old_image;
                }

                $data = TeacherDetails::find($request->id);
                if ($data->email != $request->email) {
                    DB::table('users')->where('email', $data->email)->update(array('email' => $request->email));
                }

                $insert = $data->update(
                    array('f_name' => $request->fname, 'l_name' => $request->lname, 'father_name' => $request->father_name, 'gander' => $request->gander, 'email' => $request->email, 'address' => $request->address, 'DOB' => $request->dob, 'mobile_number' => $request->mobile_number, 'category' => $request->category, 'photo' => $imageName)
                );

                if ($insert == 1) {
                    return redirect('TeacherData')->with('message', 'Teacher Data Updated successfuly');
                }
            }
        }
    }
    public function delete($id)
    {
        $teacher = TeacherDetails::find($id);

        if (!empty($teacher)) {
            unlink("images/" . $teacher->photo);
            DB::table('users')->where('email', '=', $teacher->email)->delete();
            $teacher->delete();
            return redirect()->back()->with('message', 'Teacher Deleted Successfully');
        } else {
            return redirect('TeacherData')->with('message-danger', 'Teacher Data Not Found.');
        }
    }
}
