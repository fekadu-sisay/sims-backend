<?php

namespace App\Http\Controllers;

use App\Models\CE_Courses;
use App\Models\CS_Courses;
use App\Models\IS_Courses;
use App\Models\IT_Courses;
use App\Models\SE_Courses;
use App\Models\Acc_Courses;
use Illuminate\Http\Request;
use App\Models\CyeberS_Courses;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function determineTable($data){
        if ($data == 'Accounting') {
            $table = 'acc__courses';
        } else if ($data == 'computer_science') {
            $table = 'c_s__courses';
        } else if ($data == 'Information_Technology') {
            $table = 'i_t__courses';
        } else if ($data == 'Software_Engineering') {
            $table = 's_e__courses';
        } else if ($data == 'Information_System') {
            $table = 'i_s__courses';
        } else if ($data == 'Computer_Engineering') {
            $table = 'c_e__courses';
        } else {
            $table = 'cyeber_s__courses';
        }

        return $table;
    }
    public function fetchDatacs(){
        $data = CS_Courses::all();
        return $data;
    }

    public function fetchDataacc(){
        $data = Acc_Courses::all();
        return $data;
    }

    public function fetchDatace(){
        $data = CE_Courses::all();
        return $data;
    }

    public function fetchDatase(){
        $data = SE_Courses::all();
        return $data;
    }

    public function fetchDatait(){
        $data = IT_Courses::all();
        return $data;
    }

    public function fetchDatacybers(){
        $data = CyeberS_Courses::all();
        return $data;
    }

    public function fetchDatais(){
        $data = IS_Courses::all();
        return $data;
    }

    public function addCourse(Request $request){
        $table =  $this->determineTable($request['field']);

        $newUser = DB::connection('mysql_Second')->table($table)->insert([
            'Course' => $request['course'],
            'CourseTitle' => $request['course_title'],
            'Credit' => $request['credit'],
            'Year' => $request['year'],
            'Semester' => $request['semester'],
            'CourseCategory' => $request['category']
        ]);  
         return response()->json([
            'status' => true,
        ]);
    }

    public function removeCourse(Request $request){
        $requestData = $request->all();
        $elementCount = count($requestData);
        $table = $this->determineTable($requestData[($elementCount-1)]);
        
        for($i=0;$i<=($elementCount-2);$i++){
            DB::connection('mysql_Second')->table($table)->where('Course',$requestData[$i])->delete();
        }
        return response()->json([
            'status' => true,
        ]);
    }
}