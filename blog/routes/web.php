<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\Teacher;
use App\Http\Middleware\Headmaster;
use App\Http\Middleware\Student;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/Home', [Index::class, "index"]);
Route::match(['get', 'post'], '/Login', [loginController::class, "index"]);

Route::middleware(CheckLogin::class)->namespace('\App\Http\Controllers\Api')->group(function () {

    #   Dashboard Routes
    Route::get('/Dashboard', [Dashboard::class, "index"]);
    Route::get('/ClassDetails/{id}', [Dashboard::class, "classdetails"]);

    #   Student Routes
    
    Route::get('/Logout', [loginController::class, "logout"]);
        
    Route::get('/Home/{comment?}', [Index::class, "index"])->name('Home');

    Route::group(['middleware' => ['Admin']], function () {

    Route::match(['get','post'],'/Add', [Index::class, "insert"]);
    Route::get('/delete/{id}', [Index::class, "delete"]);

    Route::get('/edit/{id}', [Index::class, "edit"]);
    Route::post('/update', [Index::class, "update"])->name('update');

    });

    #   Class Routes

    Route::get('/Class', [ClassController::class, "index"])->name('Class')->middleware(['Admin', 'Teacher']);

    Route::group(['middleware' => ['Admin']], function () {

    Route::match(['get','post'],'/AddClass', [ClassController::class, "insert"]);
    Route::get('/EditClass/{id}', [ClassController::class, "edit"]);
    Route::post('/UpdateClass', [ClassController::class, "update"])->name('UpdateClass');
    Route::get('/DeleteClass/{id}', [ClassController::class, "delete"]);

    });

    #   Subject Routes

    Route::get('/Subject', [SubjectController::class, "index"])->name('Subject')->middleware(['Admin', 'Teacher']);

    Route::group(['middleware' => ['Admin']], function () {

    Route::match(['get', 'post'], '/AddSubject', [SubjectController::class, "insert"]);
    Route::get('/EditSubject/{id}', [SubjectController::class, "edit"]);
    Route::post('/UpdateSubject', [SubjectController::class, "update"])->name('UpdateSubject');
    Route::get('/DeleteSubject/{id}', [SubjectController::class, "delete"]);

    });

    #   Timetable Routes
    
    Route::get('/Timetable', [RoutineController::class, "index"])->name('Timetable');

    Route::group(['middleware' => ['Admin']], function () {
    
    Route::match(['get', 'post'], '/AddTimetable/{id?}', [RoutineController::class, "insert"])->name('AddTimetable');
    Route::get('/EditTimetable/{id}', [RoutineController::class, "edit"]);
    Route::post('/UpdateTimetable', [RoutineController::class, "update"])->name('UpdateTimetable');
    Route::get('/DeleteTimetable/{id}', [RoutineController::class, "delete"]);

    });

    #   Teacher Routes

    Route::get('/TeacherData', [TeacherController::class, "index"])->name('TeacherData');

    Route::group(['middleware' => ['Admin']], function () {

        Route::match(['get', 'post'], '/AddTeacher', [TeacherController::class, "insert"]);
        Route::get('/EditTeacherData/{id}', [TeacherController::class, "edit"]);
        Route::post('/UpdateTeacherData', [TeacherController::class, "update"])->name('UpdateTeacherData');
        Route::get('/DeleteTeacherData/{id}', [TeacherController::class, "delete"]);

    });

    #   Attendance Routes

    Route::get('/Attendance', [AttendanceController::class, "index"])->name('Attendance')->middleware(['Admin', 'Teacher']);
    Route::match(['get', 'post'], '/SelectClass', [AttendanceController::class, "selectClass"])->middleware('Teacher');
    Route::post('/AddAttendance', [AttendanceController::class, "insert"])->middleware('Teacher');
    // Route::get('/EditTeacherData/{id}', [TeacherController::class, "edit"])->middleware('Teacher');
    // Route::post('/UpdateTeacherData', [TeacherController::class, "update"])->name('UpdateTeacherData');
    // Route::get('/DeleteTeacherData/{id}', [TeacherController::class, "delete"]);

});
