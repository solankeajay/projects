<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\ClassDetails;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

class Index extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request, $value = '')
    {
            $value = Request()->all();

            $row = 10;
            
            if(session()->get('user.position') == 'Student'){
                $student = DB::table('student')->leftJoin('class_details','class_details.id','=','student.class')->where('student.email',session()->get('user.email'))->first(['student.id as sid','student.f_name','student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category', 'class_details.id', 'class_details.class_title']);
            }else{
            
                if(isset($value['filter'])){
                    
                    $student = Student::leftJoin('class_details','class_details.id','=','student.class')->where('student.class',$value['filter'])->paginate($perPage = $row, $columns = ['student.id as sid', 'student.f_name', 'student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category','class_details.id','class_details.class_title']);

                }elseif(isset($value['sort'])){
                    if($value['sort'] == 'Date'){
        
                        $student = Student::leftJoin('class_details','class_details.id','=','student.class')->orderBy('student.DOB','ASC')->paginate($perPage = $row, $columns = ['student.id as sid', 'student.f_name', 'student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category', 'class_details.id', 'class_details.class_title']);
                    }elseif($value['sort'] == 'class'){

                        $student = Student::leftJoin('class_details','class_details.id','=','student.class')->orderBy('student.class', 'ASC')->paginate($perPage = $row, $columns = ['student.id as sid', 'student.f_name', 'student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category', 'class_details.id', 'class_details.class_title']);
                    }
                }elseif(isset($value['search'])){
                    $student = Student::leftJoin('class_details','class_details.id','=','student.class')->where('student.f_name','LIKE','%'. $value['search'].'%')->orWhere('student.l_name', 'LIKE', '%' . $value['search'] . '%')->orWhere('student.address', 'LIKE', '%' . $value['search'] . '%')->paginate($perPage = $row, $columns = ['student.id as sid', 'student.f_name', 'student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category', 'class_details.id', 'class_details.class_title']);
                }else{

                    $student = DB::table('student')->leftJoin('class_details','class_details.id','=','student.class')->paginate($perPage = $row, $columns = ['student.id as sid', 'student.f_name', 'student.l_name', 'student.DOB', 'student.role_number', 'student.gander', 'student.email', 'student.address', 'student.mobile_number', 'student.category', 'class_details.id', 'class_details.class_title']);
                }
            }

        $class = ClassDetails::get();
        $route = Route::currentRouteName();
        $sort_by = ['Birth Date' => 'Date', 'Class' => 'class'];
        return view("student.index", ['student' => $student, 'route' => $route,'sort_by'=>$sort_by,'class'=>$class]);
    }

    public function insert(Request $request)
    {
        if($request->isMethod('post')){

            $rules = [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',

                'address' => 'required|string|min:3|max:255',
                'email' => 'required|string|email|unique:users,email|max:50',
                'password' => 'required|digits between:8,16',
                'mobile_number' => 'required|digits between:10,13|unique:student,mobile_number',
                'class' => 'required',
                'category' => 'required|string|max:50',
                'student_img' => ['required','image','mimes:jpg,jpeg,png']
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);

            } else {

                // $data = $request->input();

                $imageName = time() . '.' . $request->student_img->extension();

                $request->student_img->move(public_path('images'), $imageName);

                $role_number = Student::where('class', $request->class)->get('role_number')->toArray();
                
                if (empty($role_number)) {
                    $role_number = 1;
                } else {
                    $role_number = max(array_column($role_number, 'role_number'));
             
                    $role_number++;
                }


                $insert = Student::create(
                    array('role_number'=>$role_number, 'f_name' => $request->fname,'l_name'=> $request->lname, 'father_name'=> $request->father_name, 'gander' => $request->gander,'email' => $request->email,'password'=> Hash::make($request->password), 'address'=> $request->address, 'DOB'=> $request->dob, 'mobile_number'=> $request->mobile_number ,'category' => $request->category,'class'=> $request->class,'student_image'=> $imageName)
                );

                DB::table('users')->insert(array( 'email' => $request->email, 'password'=> Hash::make($request->password),'position'=>'Student'));

                if(!empty($insert)){
                    
                    DB::statement('UPDATE class_details SET total_student=total_student+1 WHERE id=' . $request->class . '');

                    return redirect('Home')->with('message', 'Student Added successfuly');
                }

            }
        }
        $class = ClassDetails::get(['id', 'class_title']);
        return view("student.insert",['class'=>$class]);
        
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $class = ClassDetails::get(['id', 'class_title']);

        return view("student.update", ['student' => $student,'class'=>$class]);
    }
    public function update(Request $request)
    {

        if ($request->isMethod('post')) {

            $rules = [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'role_no' => 'required',

                'address' => 'required|string|min:3|max:255',
                'email' => 'required|string|email|unique:student,email,'.$request->id.'|unique:teacher_details,email|max:50',
                'mobile_number' => 'required|digits between:10,13|unique:student,mobile_number,'.$request->id.'',
                'class' => 'required',
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
                if($request->old_class != $request->class){
                    $role_number = Student::where('class', $request->class)->get('role_number')->toArray();
                    if (empty($role_number)) {
                        $role_number = 1;
                    } else {
                        $role_number = max(array_column($role_number, 'role_number'));
                        
                        $role_number++;
                    }
                }else{
                    
                    $role_number = $request->role_no;
                }

                $data = Student::find($request->id);
                if($data->email != $request->email){
                    DB::table('users')->where('email', $data->email)->update(array('email' => $request->email));
                }

                $insert = $data->update(
                    array('role_number'=>$role_number,'f_name' => $request->fname, 'l_name' => $request->lname, 'father_name' => $request->father_name, 'gander' => $request->gander, 'email' => $request->email, 'address' => $request->address, 'DOB' => $request->dob, 'mobile_number' => $request->mobile_number, 'category' => $request->category, 'class' => $request->class, 'student_image' => $imageName)
                );

                if ($insert == 1) {

                    DB::statement('UPDATE class_details SET total_student=total_student-1 WHERE id='.$request->old_class.'');
                    DB::statement('UPDATE class_details SET total_student=total_student+1 WHERE id='.$request->class.'');

                    return redirect('Home')->with('message', 'Student Updated successfuly');
                }
            }
        }
    }
    public function delete($id)
    {
        $student = Student::find($id);
        
        if(!empty($student) ){
            unlink("images/" . $student->student_image);
            DB::table('users')->where('email','=', $student->email)->delete();

            DB::statement('UPDATE class_details SET total_student=total_student-1 WHERE id='.$student->class.'');

            $student->delete();

            return redirect()->back()->with('message', 'Student Deleted Successfully');
        }else{
            return redirect('Home')->with('message-danger', 'Student Data Not Found.');
        }
    }
}
