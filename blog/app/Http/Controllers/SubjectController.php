<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectDetails;
use App\Models\ClassDetails;
use App\Models\RoutineDetails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request, $value = '')
    {
        $value = Request()->all();

        $row = 10;

        if (isset($value['filter'])) {

            $subject = SubjectDetails::leftJoin('class_details', 'class_details.id', '=', 'subject_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', '=', 'subject_details.subject_teacher')->where('class_id', $value['filter'])->paginate($perPage = $row, $columns = ['subject_details.id', 'class_details.class_title', 'subject_details.subject_name', 'teacher_details.f_name', 'teacher_details.l_name']);
        } elseif (isset($value['sort'])) {
            if ($value['sort'] == 'subject') {

                $subject = SubjectDetails::leftJoin('class_details', 'class_details.id', '=', 'subject_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', '=', 'subject_details.subject_teacher')->orderBy('subject_name', 'ASC')->paginate($perPage = $row, $columns = ['subject_details.id', 'class_details.class_title', 'subject_details.subject_name', 'teacher_details.f_name', 'teacher_details.l_name']);
            } elseif ($value['sort'] == 'class') {

                $subject = SubjectDetails::leftJoin('class_details', 'class_details.id', '=', 'subject_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', '=', 'subject_details.subject_teacher')->orderBy('class_id', 'ASC')->paginate($perPage = $row, $columns = ['subject_details.id', 'class_details.class_title', 'subject_details.subject_name', 'teacher_details.f_name', 'teacher_details.l_name']);
            }
        } elseif (isset($value['search'])) {
            $subject = SubjectDetails::leftJoin('class_details', 'class_details.id', '=', 'subject_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', '=', 'subject_details.subject_teacher')->where('subject_name', 'LIKE', '%' . $value['search'] . '%')->orWhere('teacher_details.f_name', 'LIKE', '%' . $value['search'] . '%')->orWhere('teacher_details.l_name', 'LIKE', '%' . $value['search'] . '%')->paginate($perPage = $row, $columns = ['subject_details.id', 'class_details.class_title', 'subject_details.subject_name', 'teacher_details.f_name', 'teacher_details.l_name']);
        } else {

            // $student = SubjectDetails::table('class_details')->where('user', $user_id)->paginate($row);
            $subject = SubjectDetails::leftJoin('class_details', 'class_details.id','=','subject_details.class_id')->leftJoin('teacher_details', 'teacher_details.id', '=', 'subject_details.subject_teacher')->paginate($perPage = $row, $columns = ['subject_details.id', 'class_details.class_title', 'subject_details.subject_name', 'teacher_details.f_name', 'teacher_details.l_name']);
        }
        // $subject = SubjectDetails::get();
        $class = ClassDetails::get();
        $route = Route::currentRouteName();
        $sort_by = ['Subject Name' => 'subject', 'Class' => 'class'];
       return view('subject.index',['subject'=> $subject, 'route' => $route,'sort_by'=>$sort_by,'class'=>$class]);
    }

    public function insert(Request $request)
    {

        if ($request->isMethod('post')) {
            $class_id = $request->class_id;
            $subject_name = $request->subject_title;
            // $user_id = $request->session()->get('id');
            
            $rules = [
                'subject_title' => ['required','string', Rule::unique('subject_details','subject_name')->where('class_id', $class_id)->where('subject_name', $subject_name)],
                'class_id' => 'required|max:55',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

                $insert = SubjectDetails::create(
                    array('year'=>date('Y'), 'subject_teacher'=>'0', 'class_id' => $request->class_id, 'subject_name' => $request->subject_title)
                );

                if (!empty($insert)) {
                    return redirect('Subject')->with('message', 'Subject Added successfuly');
                }
            }
        }
        $class = ClassDetails::get(['id','class_title']);
        return view('subject.insert',['class'=>$class]);
    }

    public function edit($id)
    {
        $subject = SubjectDetails::find($id);

        $class = ClassDetails::get(['id', 'class_title']);

        return view('subject.update', ['subject' => $subject,'class'=>$class]);
    }
    public function update(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'subject_title' => ['required', 'string', Rule::unique('subject_details', 'subject_name')->where('class_id', $request->class_id)->where('subject_name', $request->subject_title)->ignore($request->id)],
                'class_id' => 'required|max:50',
                
            ];
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

       
                $data = SubjectDetails::find($request->id);
                $insert = $data->update(
                    array('subject_name' => $request->subject_title, 'class_id' => $request->class_id)
                );
                $updateSubject = RoutineDetails::where(['class_id' => $data->class_id,'subject_teacher'=>$data->subject_teacher])->update(['subject'=> $request->subject_title]);
                // $updateSubject->update();
                if ($insert == 1) {
                    return redirect('Subject')->with('message', 'Subject Updated successfuly');
                }
            }
        }
    }
    public function delete($id)
    {
        $subject = SubjectDetails::find($id);
        if (!empty($subject)) {

            $subject->delete();
            return redirect()->back()->with('message', 'Subject Deleted Successfully');
        } else {
            return redirect('Subject')->with('message-danger', 'Subject Not Found.');
        }
    }

}
