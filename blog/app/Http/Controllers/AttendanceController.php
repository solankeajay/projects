<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyAttendance;
use App\Models\ClassDetails;
use App\Models\Student;
use App\Models\TeacherDetails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request, $value = '')
    {
        $value = Request()->all();

        $row = 10;

        if(isset($value['filter'])){
            // $class_name = ClassDetails::find(); 
            $attendance = DailyAttendance::leftJoin('teacher_details', 'teacher_details.id', '=', 'daily_attendances.teacher_id')->leftJoin('class_details', 'class_details.id', '=', 'daily_attendances.class_title')->leftJoin('student', 'student.id', '=', 'daily_attendances.student_id')->where('daily_attendances.class_title', $value['filter'])->paginate($perPage = $row, $columns = ['class_details.class_title', 'daily_attendances.date', 'daily_attendances.role_no', 'daily_attendances.present_or_absent', 'daily_attendances.student_name', 'teacher_details.f_name', 'teacher_details.l_name', 'daily_attendances.attend_amount_yearly','student.email','student.email']);

        }elseif(isset($value['sort'])){
            if($value['sort'] == 'date'){

                $attendance = DailyAttendance::leftJoin('teacher_details', 'teacher_details.id', '=', 'daily_attendances.teacher_id')->leftJoin('class_details', 'class_details.id', '=', 'daily_attendances.class_title')->leftJoin('student', 'student.id', '=', 'daily_attendances.student_id')->orderBy('date','ASC')->paginate($perPage = $row, $columns = ['class_details.class_title', 'daily_attendances.date', 'daily_attendances.role_no', 'daily_attendances.present_or_absent', 'daily_attendances.student_name', 'teacher_details.f_name', 'teacher_details.l_name', 'daily_attendances.attend_amount_yearly','student.email']);
            }elseif($value['sort'] == 'class'){

                $attendance = DailyAttendance::leftJoin('teacher_details', 'teacher_details.id', '=', 'daily_attendances.teacher_id')->leftJoin('class_details', 'class_details.id', '=', 'daily_attendances.class_title')->leftJoin('student', 'student.id', '=', 'daily_attendances.student_id')->orderBy('class_title', 'ASC')->paginate($perPage = $row, $columns = ['class_details.class_title', 'daily_attendances.date', 'daily_attendances.role_no', 'daily_attendances.present_or_absent', 'daily_attendances.student_name', 'teacher_details.f_name', 'teacher_details.l_name', 'daily_attendances.attend_amount_yearly','student.email']);
            }
        }elseif(isset($value['search'])){
            $attendance = DailyAttendance::leftJoin('teacher_details', 'teacher_details.id', '=', 'daily_attendances.teacher_id')->leftJoin('class_details', 'class_details.id', '=', 'daily_attendances.class_title')->leftJoin('student', 'student.id', '=', 'daily_attendances.student_id')->where('class_details.class_title','LIKE','%'. $value['search'].'%')->orWhere('daily_attendances.student_name', 'LIKE', '%' . $value['search'] . '%')->orWhere('daily_attendances.date', 'LIKE', '%' . $value['search'] . '%')->paginate($perPage = $row, $columns = ['class_details.class_title', 'daily_attendances.date', 'daily_attendances.role_no', 'daily_attendances.present_or_absent', 'daily_attendances.student_name', 'teacher_details.f_name', 'teacher_details.l_name', 'daily_attendances.attend_amount_yearly','student.email']);
        }else{

            $attendance = DB::table('daily_attendances')->leftJoin('teacher_details', 'teacher_details.id', '=', 'daily_attendances.teacher_id')->leftJoin('class_details', 'class_details.id', '=', 'daily_attendances.class_title')->leftJoin('student', 'student.id', '=', 'daily_attendances.student_id')->paginate($perPage = $row, $columns = ['class_details.class_title', 'daily_attendances.date', 'daily_attendances.role_no', 'daily_attendances.present_or_absent', 'daily_attendances.student_name', 'teacher_details.f_name', 'teacher_details.l_name','daily_attendances.attend_amount_yearly','student.email']);
        }
 
        $class = ClassDetails::get();
        $route = Route::currentRouteName();
        $sort_by = ['Date' => 'date', 'Class' => 'class'];
        return view("dailyAttendance.index", ['attendance' => $attendance, 'route' => $route,'sort_by'=>$sort_by,'class'=>$class]);
    }

    public function selectClass(Request $req){
        if ($req->isMethod('post') && $req->submit == 'submit') {

            $rules = [
                'class_id' => 'required',
            ];
            $validator = Validator::make($req->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

                $student = Student::where('class','=',$req->class_id)->get();

                $class = ClassDetails::find($req->class_id);

                if($student->count() == 0){

                    return Redirect::back()->withInput()->withErrors('No Student available in this class');

                }else{

                    return view("dailyAttendance.dailyAttendance", ['class'=>$class,'student' => $student]);
                }

            }
        }
        $class = ClassDetails::get(['id', 'class_title']);
        return view("dailyAttendance.select", ['class' => $class]);
    }
    public function insert(Request $req){
        if ($req->isMethod('post')) {

            $user_id = $req->session()->get('id');

            $x = Student::where('class','=',$req->class_title)->get('role_number')->toArray();
 
            foreach(array_column($x, 'role_number') as $value){

                $rules = [
                    'role_no_'.$value => 'required',
                    'class_title' =>  'required',
                ];
                $validator = Validator::make($req->all(), $rules);

                if ($validator->fails()) {

                    return Redirect::back()->withInput()->withErrors($validator);
               
                }


            }

            foreach (array_column($x, 'role_number') as $value) {
                
                $student_id = 's_id_'.$value;
                $role_num = 'role_no_'.$value;
                $action = 'action_'.$value;
                
                if($req->$action != ''){
                    $preset = 'P';
                }else{
                    $preset = 'A';
                }

                $teacher = TeacherDetails::where('email',$req->session()->get('user.email'))->first();
                $student = Student::find($req->$student_id);

                $insert = DailyAttendance::create(
                    array('date'=>date('d-m-Y'),'student_id' => $req->$student_id, 'teacher_id' => $teacher->id, 'class_title' => $student->class, 'student_name' => $student->f_name .' '. $student->l_name, 'role_no' => $req->$role_num, 'present_or_absent' => $preset, 'class_amount_monthly'=>0,'class_amount_yearly'=>0,'attend_amount_monthly'=>0 ,'attend_amount_yearly'=>0,'percentise_month'=>0,'percentise_year'=>0)
                );

            }

            
            if (!empty($insert)) {
                return redirect('Attendance')->with('message', 'DailyAttendance Added successfuly');
            }
        }
}

}
