<?php

namespace App\Http\Controllers;

use App\Models\Resultcs;
use App\Models\Resultse;
use App\Models\Registrar;
use App\Models\Resultacc;
use App\Models\CE_Courses;
use App\Models\CS_Courses;
use App\Models\IS_Courses;
use App\Models\IT_Courses;
use App\Models\SE_Courses;
use App\Models\Acc_Courses;
use Illuminate\Http\Request;
use App\Models\CyeberS_Courses;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{
        public function getResults(){
            $data = Resultcs::all();
            return $data;
        }

        public function setGrades(Request $request) {
            $requestData = $request->all();
            $elementCount = count($requestData);

            if ($requestData[($elementCount - 1)] == 'Accounting') {
                $table = 'acc__courses';
            } else if ($requestData[($elementCount - 1)] == 'computer_science') {
                $table = 'c_s__courses';
            } else if ($requestData[($elementCount - 1)] == 'Information_Technology') {
                $table = 'i_t__courses';
            } else if ($requestData[($elementCount - 1)] == 'Software_Engineering') {
                $table = 's_e__courses';
            } else if ($requestData[($elementCount - 1)] == 'Information_System') {
                $table = 'i_s__courses';
            } else if ($requestData[($elementCount - 1)] == 'Computer_Engineering') {
                $table = 'c_e__courses';
            } else {
                $table = 'cyeber_s__courses';
            }

            $courses = DB::connection('mysql_Second')->table($table)->pluck('Course')->toArray();
            $courseTitle = DB::connection('mysql_Second')->table($table)->pluck('CourseTitle')->toArray();//this is used to fetch courseTitle from the table named $table
            $courseCredit = DB::connection('mysql_Second')->table($table)->pluck('Credit')->toArray();
            $courseDuration = DB::connection('mysql_Second')->table($table)->pluck('Year')->toArray();
            $courseSemester = DB::connection('mysql_Second')->table($table)->pluck('Semester')->toArray();

            $data = [];

            for ($i = 0; $i < $elementCount - 2; $i++) {
                $data[] = [
                    'Course' => $courses[$i],
                    'Course_Title' => $courseTitle[$i],
                    'Credit' => $courseCredit[$i],
                    'Year' => $courseDuration[$i],
                    'Semester' => $courseSemester[$i],
                    'Grade' => $requestData[$i],
                    'idno' => $requestData[($elementCount - 2)]
                ];
            }

            Resultcs::insert($data);
            return response()->json([
            'status' => true,
            'message' => 'Data entered Successfully!'
        ]);
        }

        public function updateGrade(Request $request) {
            $requestData = $request->all();
            $elementCount = count($requestData);

            if ($requestData[($elementCount - 1)] == 'Accounting') {
                $table = 'acc__courses';
            } else if ($requestData[($elementCount - 1)] == 'computer_science') {
                $table = 'c_s__courses';
            } else if ($requestData[($elementCount - 1)] == 'Information_Technology') {
                $table = 'i_t__courses';
            } else if ($requestData[($elementCount - 1)] == 'Software_Engineering') {
                $table = 's_e__courses';
            } else if ($requestData[($elementCount - 1)] == 'Information_System') {
                $table = 'i_s__courses';
            } else if ($requestData[($elementCount - 1)] == 'Computer_Engineering') {
                $table = 'c_e__courses';
            } else {
                $table = 'cyeber_s__courses';
            }

            $courses = DB::connection('mysql_Second')->table($table)->pluck('Course')->toArray();
            $courseTitle = DB::connection('mysql_Second')->table($table)->pluck('CourseTitle')->toArray();
            $courseCredit = DB::connection('mysql_Second')->table($table)->pluck('Credit')->toArray();
            $courseDuration = DB::connection('mysql_Second')->table($table)->pluck('Year')->toArray();
            $courseSemester = DB::connection('mysql_Second')->table($table)->pluck('Semester')->toArray();

            $data = [];

            for ($i = 0; $i < $elementCount - 2; $i++) {
                $data[] = [
                    'Course' => $courses[$i],
                    'Course_Title' => $courseTitle[$i],
                    'Credit' => $courseCredit[$i],
                    'Year' => $courseDuration[$i],
                    'Semester' => $courseSemester[$i],
                    'Grade' => $requestData[$i],
                    'idno' => $requestData[($elementCount - 2)]
                ];
            }
            Resultcs::where('idno', $requestData[($elementCount - 2)])->delete();
            Resultcs::insert($data);
            return response()->json([
            'status' => true,
            'message' => 'Grade Updated Successfully!'
        ]);
        }

        // public function updateGrade(Request $request){
        //     $requestData = $request->all();
        //     $elementCount = count($requestData);
        //     $id = $requestData[($elementCount-2)];
        //     $arrayEnd = $elementCount-3;
        //     // $data = Resultcs::where('idno', $id)->get()->toArray();
        //     $data = Resultcs::where('idno', $id)->pluck('Grade')->toArray();
        //     for($i=0;$i<=$arrayEnd;$i++){
        //         $data[$i] = $requestData[$i];
        //     }
        //     return $data;
        // }


    //     public function updateGrade(Request $request){
    //         $requestData = $request->all();
    //         $elementCount = count($requestData);
    //         $field =$requestData[($elementCount-1)];
    //         $id = $requestData[($elementCount-2)];
    //         $arrayEnd = ($elementCount-3);
    //         $prev = Resultcs::where('idno', $id)->pluck('Grade')->toArray();
    //         for($i=0;$i<=$arrayEnd;$i++){
    //         //     $grade[$i] = $requestData[$i];
    //         //     if($prev[$i] !== $grade[$i]){
    //         //         Resultcs::where('idno', $id)->update(['Grade' => $grade[$i]]);
    //         //     }else if($prev[$i] === $grade[$i]){
    //         //         Resultcs::where('idno', $id)->update(['Grade' => $prev[$i]]);
    //         // }
    //         Resultcs::where('idno', $id)->update(['Grade' => $requestData[$i]]);
    //     }
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Grade Updated Successfully!',
    //         ]);
    // }








        public function removeUser($id){
            Resultcs::where('idno',$id)->delete();
            Registrar::where('idno',$id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'User removed Successfully!'
            ]);
        }
    }





        // function setGrades(Request $request) {
        //     $requestData = $request->all();

        //     $elementCount = count($requestData);

        //     return $elementCount;
        // }

                    // if ($elementCount >= 2) {
            //     $data[] = [
            //         'Course' => $courses[1],
            //         'Course_Title' => $courseTitle[1],
            //         'Credit' => $courseCredit[1],
            //         'Year' => $courseDuration[1],
            //         'Semester' => $courseSemester[1],
            //         'Grade' => $requestData[1],
            //         'idno' => 'cs99'
            //     ];
            // }

        // public function results_se(){
        //     $data = Resultse::all();
        //     return $data;
        // }
        // public function results_acc(){
        //     $data = Resultacc::all();
        //     return $data;
        // }

        // public function results_it(){
        //     $data = Resultacc::all();
        //     return $data;
        // }
        // public function results_is(){
        //     $data = Resultacc::all();
        //     return $data;
        // }
        // public function results_ce(){
        //     $data = Resultacc::all();
        //     return $data;
        // }
        // public function results_cybers(){
        //     $data = Resultacc::all();
        //     return $data;
        // }
