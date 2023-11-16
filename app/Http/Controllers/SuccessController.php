<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuccessController extends Controller
{
    public function verificationSuccess(){
        $verificationData = Session::get('verification_data');
        return view('success',['verificationData' => $verificationData]);
    }
}
