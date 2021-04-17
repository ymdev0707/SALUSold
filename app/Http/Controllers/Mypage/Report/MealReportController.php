<?php

namespace App\Http\Controllers\Mypage\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MealReportInformation;
use App\Functions\Common;

class MealReportController extends Controller
{
    //
    public function index(){
        $mealreport = MealReportInformation::get_mealreprot(date("Y/m/d"),$user_id = Auth::id());
        return view('mypage/mealreport')->with([
            "mealreport" => $mealreport,
        ]);
    }

    public function regist(Request $request){
        // 食事報告を登録する
        $input = $request->input();
        Common::debug($input);
        exit;
        MealReportInformation::regist_mealreport();
    }

}
