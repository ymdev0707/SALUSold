<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class user_profile extends Model
{    
    /**
     * updateprofile
     *
     * @param  mixed $id
     * @param  mixed $input
     * @return void
     */
    public static function updateprofile($id, $input){
        $result = false;
        $user = User::find($id);
        $user->first_name    = Arr::get($input, 'firstName');
        $user->last_name     = Arr::get($input, 'lastName');
        $user->email         = Arr::get($input, 'email');
        $result = $user->save();
        
        return $result;
    }
}
