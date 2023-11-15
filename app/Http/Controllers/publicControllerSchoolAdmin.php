<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\uesr;
use App\models\Teatcher;
use App\models\school;
use Illuminate\Support\Facades\Auth;



class publicControllerSchoolAdmin extends Controller
{
    public function getprofileImageForAllUsers(){
        $user = Auth::user();
        return $user;

    }
}
