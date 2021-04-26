<?php

namespace App\Http\Controllers\Mypage\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MealReportInformation;
use App\Models\MealReportInformationDetails;
use App\Functions\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use DateTime;

use function Psy\debug;

class MealReportController extends Controller
{
    //    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request){
        $input = $request->input();
        $input_date = Arr::get($input,'target_date', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y/m/d');

        if(empty($target_date)){
            $target_date = new DateTime();
            $target_date = $target_date->format('Y/m/d');
        }

        $mealreport = MealReportInformation::get_mealreprot($target_date, $user_id = Auth::id());

        $disp_target_date = new DateTime($target_date);
        $disp_target_date = $disp_target_date->format('Y-m-d');

        return view('mypage/mealreport')->with([
            "mealreport" => $mealreport,
            "target_date" => $disp_target_date,
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
        $target_date = $input['form_target_date'];
        $user_id = Auth::id();
        $meal_report_information_id = null;

        DB::beginTransaction();
        try {
            // 食事報告情報を登録
            $judge_result = MealReportInformation::judge_regist_process($target_date, $user_id);
            if(!$judge_result){
                $meal_report_information = MealReportInformation::regist_mealreport($target_date, $user_id);
                $meal_report_information_id = $meal_report_information->id;
            }else{
                $meal_report_information_id = $judge_result;
            }
            
            // 食事報告情報詳細を登録
            $param = array(
                'meal_report_information_id' => $meal_report_information_id,
                'display_number' => 0,
                'user_report' => Arr::get($input,'user_report'),
                'trainner_comment' => Arr::get($input,'trainner_comment'),
                'ingestion_calorie' => Arr::get($input,'ingestion_calorie'),
                'meal_image' => Arr::get($input,'meal_image'),
                'ingestion_time' => Arr::get($input,'ingestion_time'),
            );
            $meal_report_information = MealReportInformationDetails::regist_mealreport_details($param);
            DB::commit();
            $target_date = new DateTime($input['form_target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('mypage/mealreport/?target_date=' . $target_date);
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request){
        DB::beginTransaction();
        $input = $request->input();
        try {
            $result = MealReportInformationDetails::update_mealreport_details($input);
            DB::commit();
            $target_date = new DateTime($input['form_target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('mypage/mealreport/?target_date=' . $target_date);
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }
    }
    /**
     * delete
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request){
        DB::beginTransaction();
        $input = $request->input();
        try {
            $result = MealReportInformationDetails::delete_mealreport_details(Arr::get($input,'meal_report_information_detail_id'));
            DB::commit();
            $target_date = new DateTime($input['form_target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('mypage/mealreport/?target_date=' . $target_date);
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }
    }
}
