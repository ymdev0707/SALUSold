<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\user_profile;
use App\Common;


class ProfileController extends Controller
{
        
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request){

        $id = Auth::id();
        $input = $request->input();
        $result = user_profile::updateprofile($id, $input);
        if(!$result){
            
        }
        
        return redirect('/home');
    }
}
