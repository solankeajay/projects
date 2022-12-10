<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TeacherDetails;
use App\Models\DailyAttendance;
use App\Models\ClassDetails;
class Dashboard extends Controller
{
    public function index(Request $request, $value = '')
    {

        $total_student = Student::get()->count();
        $total_teacher = TeacherDetails::get()->count();
        $total_attend = DailyAttendance::where('date',date('d-m-Y'))->where('present_or_absent','P')->get()->count();
        $class_details = ClassDetails::get();
 
        if(session()->get('user.position') != 'Student'){
            return view("dashboard",['total_student'=> $total_student, 'total_teacher'=> $total_teacher, 'total_attend'=> $total_attend, 'class_details'=> $class_details]);
        }else{
            return redirect('Timetable');
        }

    }

    public function classdetails($id)
    {
        $student = Student::where('class',$id)->get();
        return view('class.class',['student'=>$student]);
    }
}
