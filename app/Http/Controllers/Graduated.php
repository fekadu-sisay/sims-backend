<?php

namespace App\Http\Controllers;

use App\Models\CeGraduated;
use App\Models\CsGraduated;
use App\Models\IsGraduated;
use App\Models\ItGraduated;
use App\Models\SeGraduated;
use App\Models\AccGraduated;
use Illuminate\Http\Request;
use App\Models\CyberGraduated;

class Graduated extends Controller
{
    public function sendListAcc(){
        $data = AccGraduated::all();
        return $data;
    }
    public function sendListCe(){
        $data = CeGraduated::all();
        return $data;
    }
    public function sendListCs(){
        $data = CsGraduated::all();
        return $data;
    }
    public function sendListCyber(){
        $data = CyberGraduated::all();
        return $data;
    }
    public function sendListIs(){
        $data = IsGraduated::all();
        return $data;
    }
    public function sendListIt(){
        $data = ItGraduated::all();
        return $data;
    }
    public function sendListSe(){
        $data = SeGraduated::all();
        return $data;
    }
}