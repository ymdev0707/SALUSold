<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(){

        $id = Auth::id();
        $user = User::find($id);
        return view('mypage/profile', $user);
    }
}
