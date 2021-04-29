<?php

namespace App\Http\Controllers;

use App\Functions\Common;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use App\Models\User;

class MsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $id;

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {

        //     // ココに書く
        //     $this->id = Auth::id();
        //     $result = User::is_admin($this->id);
        //     if($result == false){
        //         return redirect('/login');
        //     }

        //     return $next($request);
        // });
    }
}
