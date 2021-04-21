<?php

namespace App\Http\Controllers\Mypage\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MealReportInformation;
use App\Models\MealReportInformationDetail;
use App\Functions\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use function Psy\debug;

class MealReportController extends Controller
{
    //    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        $mealreport = MealReportInformation::get_mealreprot(date("Y/m/d"),$user_id = Auth::id());
        return view('mypage/mealreport')->with([
            "mealreport" => $mealreport,
        ]);
    }
        
    /**
     * regist
     *
     * @param  mixed $request
     * @return void
     */
    public function regist(Request $request){
        // 食事報告を登録する
        $input = $request->input();
        $target_date = $input['target_date'];
        $user_id = Auth::id();

        DB::beginTransaction();
        try {
            // 食事報告情報を登録
            $meal_report_information = MealReportInformation::regist_mealreport($target_date, $user_id);
            // 食事報告情報詳細を登録
            $reports = $input['report_value'];
            $id = $meal_report_information->id;

            foreach ($reports as $key => $report) {
                $param = array(
                    'meal_report_information_id' => $id,
                    'display_number' => $key + 1,
                    'user_report' => Arr::get($report,'user_report'),
                    'trainner_comment' => Arr::get($report,'trainner_comment'),
                    'ingestion_calorie' => Arr::get($report,'ingestion_calorie'),
                    'meal_image' => Arr::get($report,'meal_image'),
                    'ingestion_time' => Arr::get($report,'ingestion_time'),
                );
                $meal_report_information = MealReportInformationDetail::regist_mealreport_detail($param);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
