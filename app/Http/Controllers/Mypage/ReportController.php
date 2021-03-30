<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ReportController extends Controller
{
    //
    public function index(){
        return view('mypage/bodyweight');
    }
}
