<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MealReportInformation;

class ReportController extends Controller
{
    //
    public function index(Request $request){
        $type = $request->type;
        $test=12;
        switch ($type) {
            case 'meal':
                $mealreport = MealReportInformation::get_mealreprot(date("Y/m/d"),$user_id = Auth::id());
                return view('mypage/mealreport')->with([
                    "mealreport" => $mealreport,
                ]);
                break;
            case 'workout':
                # code...
                break;
            case 'bodyweight':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }
}
