<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Admin;
use App\Models\Reports;
use App\Models\Resultcs;
use App\Models\Registrar;
use App\Models\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;



class UserController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ]);

        $mail_data = [
            'recipient' => $request->email,
            'fromEmail' => 'fekadusisay03@gmail.com',
            'fromName' => 'Admin',
            'subject' => $request->subject,
            'body' => $request->body,
        ];

        Mail::send([], [], function($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject'])
                ->text($mail_data['body']);
        });

        return response()->json([
            'status' => true,
        ]);
    }



    public function removeUser(Request $request){
        Reports::where('FirstName',$request->name)->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function seeReports(){
        // $data = Reports::orderBy('id', 'desc')->get();//asc
        $data = Reports::all();
        return $data;
    }

    public function saveReport(Request $request){
        $report = Reports::insert([
            'FirstName' => $request->name,
            'LastName' => $request->lname,
            'Email' => $request->email,
            'Title' => $request->title,
            'Report' => $request->complain,
            'idno' => $request->id
        ]);
        return response()->json([
            'status' => true
        ]);
    }

    public function showRegisteredStudents(){
        $data = Registrar::all();
        return $data;
    }

    public function addUser(Request $request) {
        // $validatedData = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:6',
        // ]);
        $newUser = Registrar::create([
            'Username' => $request->username,
            'Field of study' => $request->fos,
            'Duration of study' => $request->dos,
            'idno' => $request->idno,
            'Email' => $request->email
        ]);
        return response()->json(['message' => 'Success', 'user' => $request->username,'fos'=>$request->fos,'id'=>$request->idno]);
    }

  public function register(Request $request){
    $validator = Validator::make($request->all(), [
        'userName' => 'required|string|max:30|min:3',
        'userEmail' => 'required|email|min:5|max:40',
        'userPassword' => 'required|min:8',
        'confirm_password' => 'required_with:userPassword|same:userPassword'
    ], [
        'userName.required' => 'The user name is required.',
        'userName.string' => 'The user name must be a string.',
        'userName.alpha' => 'The user name must only contain letters.',
        'userName.max' => 'The user name must not exceed :max characters.',
        'userName.min' => 'The user name must be at least :min characters.',
        'userEmail.required' => 'The user email is required.',
        'userEmail.email' => 'Invalid email format.',
        'userEmail.min' => 'The user email must be at least :min characters.',
        'userEmail.max' => 'The user email must not exceed :max characters.',
        'userPassword.required' => 'The user password is required.',
        'userPassword.min' => 'The user password must be at least :min characters.',
        'confirm_password.required_with' => 'The confirmation password is required.',
        'confirm_password.same' => 'The confirmation password must match the user password.',
    ]);

    $validationStatus = $validator->passes();

    $fieldStatus = [];
    foreach ($validator->getMessageBag()->toArray() as $field => $messages) {
        $fieldStatus[$field] = [
            'status' => false,
            'errors' => $messages
        ];
    }

    if (!$validationStatus) {
        return response()->json([
            'status' => false,
            'fieldStatus' => $fieldStatus
        ]);
    } else {
        $user = [
            'name' => $request->input('userName'),
            'email' => $request->input('userEmail'),
            'password' => $request->input('userPassword'),
            'isAdmin' => '0'
        ];

        $registeredUser = Registered::create($user);
        $token = auth()->login($registeredUser);

        return response()->json([
            'status' => true,
            'user' => $user['name'],
            'token' => $token
        ]);
    }
}



public function confirmSingup(){
  $loggedIn = auth()->check();
  $userName = $loggedIn ? auth()->user()->name : null;
  return response()->json(['loggedIn' => $loggedIn, 'name' => $userName]);
}

public function checkCredentials($name, $password)
{
    $user = Registered::where('name', $name)->first();

    if ($user && Hash::check($password, $user->password)) {
        return true;
    }
    return false;
}

public function login(Request $request)
{
    $credentials = $request->only('name', 'password');
    $isAdmin = Registered::where('name',$request->name)->first();

        if (!$token =auth()->attempt($credentials)) {
            return response()->json(['loggedin' => 'no']);
        }
else{
       return response()->json([
        'loggedin' => 'yes',
        'name' => $request->name,
        'userType' => $isAdmin->isAdmin,
        'token' => $token,

    ]);
}


}


 public function sendUserInfo(){
             $data = Registrar::all();
             return $data;
 }


 public function __construct(){
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
                'sendUserInfo',
                'addUser' ,
                'showRegisteredStudents' ,
                'saveReport',
                'seeReports' ,
                'removeUser',
                'sendEmail'
            ]
            ]);
 }


}
