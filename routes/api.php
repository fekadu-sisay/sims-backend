<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Graduated;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:registereds'])->group(function () {
});

Route::get('/courses/computer_science',[CoursesController::class,'fetchDatacs']);
Route::get('/courses/Accounting',[CoursesController::class,'fetchDataacc']);
Route::get('/courses/Computer_Engineering',[CoursesController::class,'fetchDatace']);
Route::get('/courses/Software_Engineering',[CoursesController::class,'fetchDatase']);
Route::get('/courses/Cyber_Security',[CoursesController::class,'fetchDatacybers']);
Route::get('/courses/Information_System',[CoursesController::class,'fetchDatais']);
Route::get('/courses/Information_Technology',[CoursesController::class,'fetchDatait']);

Route::get('/', function () {
    return view('http://localhost:5173/');
});

Route::post('/logout',[UserController::class,'logout']);
Route::post('/create',[UserController::class,'register']);
Route::post('/adduser',[UserController::class,'addUser']);
Route::post('/login',[UserController::class,'login']);
Route::get('/signup/status',[UserController::class,'signupStatus']);

Route::get('graduated/Accounting/2023',[Graduated::class,'sendListAcc']);
Route::get('graduated/Computer_Engineering/2023',[Graduated::class,'sendListCe']);
Route::get('graduated/computer_science/2023',[Graduated::class,'sendListCs']);
Route::get('graduated/Cyber_Security/2023',[Graduated::class,'sendListCyber']);
Route::get('graduated/Information_System/2023',[Graduated::class,'sendListIs']);
Route::get('graduated/Information_Technology/2023',[Graduated::class,'sendListIt']);
Route::get('graduated/Software_Engineering/2023',[Graduated::class,'sendListSe']);

Route::get('{field}/{username}/all',[GradesController::class,'getResults']);
Route::get('/userinfo',[UserController::class,'sendUserInfo']);
Route::get('/showusers',[UserController::class,'showRegisteredStudents']);
Route::post('/setgrades',[GradesController::class,'setGrades']);
Route::put('/updategrades',[GradesController::class,'updateGrade']);
Route::delete('/removeuser/{id}',[GradesController::class,'removeUser']);

Route::post('/addcourse',[CoursesController::class,'addCourse']);
Route::post('/removecourse',[CoursesController::class,'removeCourse']);
Route::post('/sendreport',[UserController::class,'saveReport']);
Route::get('/seereports',[UserController::class,'seeReports']);
Route::post('/removeReport',[UserController::class,'removeUser']);
Route::post('/sendemail',[UserController::class,'sendEmail']);
