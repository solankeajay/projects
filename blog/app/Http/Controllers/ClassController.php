<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassDetails;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function index(Request $request, $value = '')
    {
        $value = Request()->all();

        $row = 10;

        $user_id = $request->session()->get('id');

        if (isset($value['sort'])) {
            if ($value['sort'] == 'total') {

                $class = ClassDetails::orderBy('total_student', 'ASC')->paginate($row);
            } elseif ($value['sort'] == 'class') {

                $class = ClassDetails::orderBy('class_title', 'ASC')->paginate($row);
            }
        } elseif (isset($value['search'])) {
            $class = ClassDetails::where('class_title', 'LIKE', '%'.$value['search'].'%')->orWhere('class_code', 'LIKE','%'.$value['search'].'%')->paginate($row);
        } else {

            $class = ClassDetails::paginate($row);
        }
        $route = Route::currentRouteName();
        $sort_by =['Student Amount'=>'total','Class'=>'class'];

       return view('class.index',['class'=>$class,'route'=>$route, 'sort_by'=> $sort_by]);
    }

    public function insert(Request $request)
    {

        if ($request->isMethod('post')) {

            // $user_id = $request->session()->get('id');

            $rules = [
                'Class_title' => 'required|string|unique:class_details,class_title|max:55',
                'class_code' => 'required|string|unique:class_details,class_code|max:55',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

                $insert = ClassDetails::create(
                    array('class_title' => $request->Class_title, 'class_code' => $request->class_code, 'total_student' => 0, 'daily_attendance' => 0, 'yearly_attendance' => 0)
                );

                if (!empty($insert)) {
                    return redirect('Class')->with('message', 'Class Added successfuly');
                }
            }
        }

        return view('class.insert');
    }

    public function edit($id)
    {
        $class = ClassDetails::find($id);

        return view('class.update', ['class' => $class]);
    }
    public function update(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'Class_title' => 'required|string|unique:class_details,class_title,'.$request->id.'|max:50',
                'class_code' => 'required|digits between:1,20|unique:class_details,class_code,'.$request->id.'|max:50',
                
            ];
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return Redirect::back()->withInput()->withErrors($validator);
            } else {

       
                $data = ClassDetails::find($request->id);
                Student::where(['class'=>$data->class_title])->update(['class'=>$request->Class_title]);
                $insert = $data->update(
                    array('class_title' => $request->Class_title, 'class_code' => $request->class_code)
                );

                if ($insert == 1) {
                    return redirect('Class')->with('message', 'Class Updated successfuly');
                }
            }
        }
    }
    public function delete($id)
    {
        $class = ClassDetails::find($id);
        if (!empty($class)) {

            $class->delete();
            return redirect()->back()->with('message', 'Class Deleted Successfully');
        } else {
            return redirect('Class')->with('message-danger', 'Class Not Found.');
        }
    }
}
