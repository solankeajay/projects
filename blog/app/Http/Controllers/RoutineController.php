<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoutineDetails;
use App\Models\ClassDetails;
use App\Models\TeacherDetails;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use App\Models\SubjectDetails;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoutineController extends Controller
{
    public function index(Request $request, $value = '')
    {
        $value = Request()->all();

        $row = 10;

        if(session()->get('user.position') == 'Student'){
            $student_class = Student::where('email', session()->get('user.email'))->first();
            $student_class = ClassDetails::where('class_title', $student_class->class)->first('id');

            $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->where('class_id', $student_class->id)->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
        }else{

            if (isset($value['filter'])) {

                $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->where('class_id', $value['filter'])->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
            } elseif (isset($value['sort'])) {
                if ($value['sort'] == 'day') {

                    $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->orderBy('day_title', 'ASC')->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
                } elseif ($value['sort'] == 'class') {

                    $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->orderBy('class_id', 'ASC')->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
                }
            } elseif (isset($value['search'])) {
                $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->where('day_title', 'LIKE', '%' . $value['search'] . '%')->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
            } else {

                $timetable = RoutineDetails::leftJoin('class_details', 'class_details.id', '=', 'routine_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', 'routine_details.subject_teacher')->paginate($perPage = $row, $columns = ['routine_details.id', 'routine_details.day_title', 'routine_details.subject', 'routine_details.subject_teacher', 'routine_details.start_time', 'routine_details.end_time', 'routine_details.classroom_number', 'class_details.class_title', 'teacher_details.f_name', 'teacher_details.l_name']);
            }
        // $subject = SubjectDetails::get();
        }

        $class = ClassDetails::get();
        $route = Route::currentRouteName();
        $sort_by = ['Day' => 'day', 'Class' => 'class'];

        return view('timetable.index', ['timetable' => $timetable, 'route' => $route,'sort_by'=>$sort_by,'class'=>$class]);
    }

    public function insert(Request $request,$id='')
    {   

        if ($request->isMethod('post')) {
            
            $rules = [
                'c_id' => ['required',Rule::unique('routine_details', 'class_id')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->c_id)->where('day_title', $request->day)->where(
                        function ($query) use ($request) {
                        return $query->where(
                                        [
                            ['start_time','>=',$request->start_time],
                            ['start_time','<=',$request->end_time]
                        ])->orWhere([
                            ['end_time','>=',$request->start_time],
                            ['end_time','<=',$request->end_time] 
                        ]);})->orWhere(
                            function ($query) use ($request) {
                                return $query->where([

                                ['start_time','<=',$request->start_time],
                                ['end_time','>=',$request->start_time]
                            ])->orWhere([
                                ['start_time','<=',$request->end_time],
                                ['end_time','>=',$request->end_time] 
                            ]);
                        });
                })],

                'day' => 'required',

                'subject' => 'required',

                'teacher' => ['required',Rule::unique('routine_details', 'subject_teacher')->where(function ($query) use ($request) {
                    return $query->where('subject_teacher', $request->teacher)->where('day_title', $request->day)->where(
                        function ($query) use ($request) {
                        return $query->where(
                                        [
                            ['start_time','>=',$request->start_time],
                            ['start_time','<=',$request->end_time]
                        ])->orWhere([
                            ['end_time','>=',$request->start_time],
                            ['end_time','<=',$request->end_time] 
                        ]);})->orWhere(
                            function ($query) use ($request) {
                                return $query->where([

                                ['start_time','<=',$request->start_time],
                                ['end_time','>=',$request->start_time]
                            ])->orWhere([
                                ['start_time','<=',$request->end_time],
                                ['end_time','>=',$request->end_time] 
                            ]);
                        });
                })],

                'start_time' => ['required'],

                'end_time' => 'required',

                'class_no' => ['required','max:55',Rule::unique('routine_details', 'classroom_number')->where(function ($query) use ($request) {
                    return $query->where('classroom_number', $request->class_no)->where('day_title', $request->day)->where(
                        function ($query) use ($request) {
                        return $query->where(
                                        [
                            ['start_time','>=',$request->start_time],
                            ['start_time','<=',$request->end_time]
                        ])->orWhere([
                            ['end_time','>=',$request->start_time],
                            ['end_time','<=',$request->end_time] 
                        ]);})->orWhere(
                            function ($query) use ($request) {
                                return $query->where([

                                ['start_time','<=',$request->start_time],
                                ['end_time','>=',$request->start_time]
                            ])->orWhere([
                                ['start_time','<=',$request->end_time],
                                ['end_time','>=',$request->end_time] 
                            ]);
                        });
                })],
                
            ];

            $validator = Validator::make($request->all(), $rules,[
                'c_id' => 'This class has already been taken in this time and day.',
                'teacher' => 'The Teacher has already been taken in this time.',
                'class_no' => 'The classroom number has already been taken in this time.'
            ]);
         
            
            if ($validator->fails()) {
                
                return Redirect::back()->withInput()->withErrors($validator);
            } else {
                
                $insert = RoutineDetails::create(
                    array('class_id' => $request->c_id, 'day_title' => $request->day, 'subject' => $request->subject, 'subject_teacher' => $request->teacher, 'start_time'=> $request->start_time, 'end_time'=> $request->end_time, 'classroom_number'=> $request->class_no)
                );

                if (!empty($insert)) {
                    $subject = SubjectDetails::where('id','=',$request->subject)->where('class_id','=',$request->c_id)->first();
                    $subject->update(['subject_teacher' => $request->teacher]);
                    return redirect('Timetable')->with('message', 'Timetable Added successfuly');
                }
            }
        }

        if(!empty($id)){
            // $subject = SubjectDetails::get(['id as subject_id', 'subject_name']);
            $subject = SubjectDetails::where('class_id','=',$id)->get(['class_id', 'id as subject_id', 'subject_name'])->toArray();
        }else{

            $subject = SubjectDetails::get(['class_id','id as subject_id','subject_name'])->toArray();
        }
        $class = ClassDetails::get(['id', 'class_title']);

        $teacher = TeacherDetails::get(['id','f_name','l_name']);

        return view('timetable.insert',['c_id'=>$id,'class'=>$class,'subject'=>$subject,'teacher'=>$teacher]);
    }

    public function edit($id)
    {
        $routine = RoutineDetails::find($id);
        $subject = SubjectDetails::get(['id', 'subject_name']);
        $teacher = TeacherDetails::get(['id', 'f_name', 'l_name']);
        // $class = ClassDetails::get(['id', 'class_title']);

        return view('timetable.update', ['routine' => $routine, 'subject'=>$subject ,'teacher' => $teacher]);
    }
    public function update(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [

                'day' => 'required',
                'subject' => 'required',
                'teacher' => ['required',Rule::unique('routine_details', 'subject_teacher')->where(function ($query) use ($request) {
                    return $query->where('subject_teacher', $request->teacher)->where('day_title', $request->day)->where(
                        function ($query) use ($request) {
                        return $query->where(
                                        [
                            ['start_time','>=',$request->start_time],
                            ['start_time','<=',$request->end_time]
                        ])->orWhere([
                            ['end_time','>=',$request->start_time],
                            ['end_time','<=',$request->end_time] 
                        ]);})->orWhere(
                            function ($query) use ($request) {
                                return $query->where([

                                ['start_time','<=',$request->start_time],
                                ['end_time','>=',$request->start_time]
                            ])->orWhere([
                                ['start_time','<=',$request->end_time],
                                ['end_time','>=',$request->end_time] 
                            ]);
                        });
                })->ignore($request->id)],
                'start_time' => 'required',
                'end_time' => 'required',
                'class_no' => ['required','max:55',Rule::unique('routine_details', 'classroom_number')->where(function ($query) use ($request) {
                    return $query->where('classroom_number', $request->class_no)->where('day_title', $request->day)->where(
                        function ($query) use ($request) {
                        return $query->where(
                                        [
                            ['start_time','>=',$request->start_time],
                            ['start_time','<=',$request->end_time]
                        ])->orWhere([
                            ['end_time','>=',$request->start_time],
                            ['end_time','<=',$request->end_time] 
                        ]);})->orWhere(
                            function ($query) use ($request) {
                                return $query->where([

                                ['start_time','<=',$request->start_time],
                                ['end_time','>=',$request->start_time]
                            ])->orWhere([
                                ['start_time','<=',$request->end_time],
                                ['end_time','>=',$request->end_time] 
                            ]);
                        });
                })->ignore($request->id)],
            ];
            $validator = Validator::make($request->all(), $rules,[
                'teacher' => 'The Teacher has already been taken in this time.',
                'class_no' => 'The classroom number has already been taken in this time.'
            ]);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {


                $data = RoutineDetails::find($request->id);

                $insert = $data->update(
                    array('day_title' => $request->day, 'subject' => $request->subject, 'subject_teacher' => $request->teacher, 'start_time' => $request->start_time, 'end_time' => $request->end_time, 'classroom_number' => $request->class_no));

                if ($insert == 1) {
                    SubjectDetails::where('subject_name','=',$request->subject)->where('class_id','=',$data->class_id)->update(['subject_teacher' => $request->teacher]);

                    return redirect('Timetable')->with('message', 'Timetable Updated successfuly');
                }
            }
        }
    }
    public function delete($id)
    {
        $routine = RoutineDetails::find($id);
        if (!empty($routine)) {

            $routine->delete();
            
            $check_teacher = RoutineDetails::where('subject', '=', $routine->subject)->where('class_id', '=', $routine->class_id)->where('subject_teacher','=',$routine->subject_teacher)->get()->count();
 
            if($check_teacher == 0){
            $subject = SubjectDetails::where('subject_name', '=', $routine->subject)->where('class_id', '=', $routine->class_id)->first();
            $subject->update(['subject_teacher' => 0]);
            }
            return redirect()->back()->with('message', 'Subject Timetable Deleted Successfully');
        } else {
            return redirect('Timetable')->with('message-danger', 'Subject Timetable Not Found.');
        }
    }
}
