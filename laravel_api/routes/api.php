<?php

use App\Http\Controllers\simpleController;
use App\Http\Controllers\Sanctum\StudentController;
use App\Http\Controllers\Sanctum\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Simple Api Routes Without Authentication

Route::post("insert",[simpleController::class,"insert"]);
Route::get("select",[simpleController::class,"select"]);
Route::get("singleSelect/{id}",[simpleController::class,"singleSelect"]);
Route::put("update/{id}",[simpleController::class,"update"]);
Route::delete("delete/{id}",[simpleController::class,"delete"]);


#Sanctum Authentication Api Routes

Route::post("register",[StudentController::class, "register"]);
Route::post("login",[StudentController::class,"login"]);

Route::group(["middleware"=> ["auth:sanctum"]],function(){

    Route::get("profile", [StudentController::class, "profile"]);
    Route::get("logout", [StudentController::class, "logout"]);

    Route::post("create", [ProjectController::class, "create"]);
    Route::get("list", [ProjectController::class, "list"]);
    Route::get("single/{id}", [ProjectController::class, "single"]);
    Route::delete("delete-project/{id}", [ProjectController::class, "delete"]);
});



