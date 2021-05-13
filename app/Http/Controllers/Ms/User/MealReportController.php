<?php

namespace App\Http\Controllers\Ms\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealReportInformation;
use App\Models\MealReportInformationDetails;
use App\Functions\Common\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use DateTime;
use App\Models\User;
use Symfony\Component\ErrorHandler\Debug;

class MealReportController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request){
        $init_report_data = $this->init_report($request);
        return view('ms/userinformation/detail')->with([
            'physicalinformation' => $init_report_data['physicalinformation'],
            'target_date' => $init_report_data['target_date'],
            'param_target_date' => $init_report_data['param_target_date'],
            'user_id' => $request->user_id,
            'report_type' => 'mealreport',
            'user_information' => $init_report_data['user_information'],
            'mealreport' => $init_report_data['mealreport'],
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
        $user_id = $request->user_id;
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
                'trainer_report' => Arr::get($input,'trainer_report'),
                'ingestion_calorie' => Arr::get($input,'ingestion_calorie'),
                'meal_image' => Arr::get($input,'meal_image'),
                'ingestion_time' => Arr::get($input,'ingestion_time'),
            );
            $meal_report_information = MealReportInformationDetails::regist_mealreport_details($param);
            DB::commit();
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }

        $init_report_data = $this->init_report($request);
        return view('ms/userinformation/detail')->with([
            'physicalinformation' => $init_report_data['physicalinformation'],
            'target_date' => $init_report_data['target_date'],
            'param_target_date' => $init_report_data['param_target_date'],
            'user_id' => $user_id,
            'report_type' => 'mealreport',
            'user_information' => $init_report_data['user_information'],
            'mealreport' => $init_report_data['mealreport'],
        ]);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request){
        $input = $request->input();
        DB::beginTransaction();
        try {
            $result = MealReportInformationDetails::update_mealreport_details($input);
            DB::commit();
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }

        $init_report_data = $this->init_report($request);
        return view('ms/userinformation/detail')->with([
            'physicalinformation' => $init_report_data['physicalinformation'],
            'target_date' => $init_report_data['target_date'],
            'param_target_date' => $init_report_data['param_target_date'],
            'user_id' => $request->user_id,
            'report_type' => 'mealreport',
            'user_information' => $init_report_data['user_information'],
            'mealreport' => $init_report_data['mealreport'],
        ]);
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
            $result = MealReportInformationDetails::delete_mealreport_details(Arr::get($input,'meal_report_information_details_id'));
            DB::commit();
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }

        $init_report_data = $this->init_report($request);
        return view('ms/userinformation/detail')->with([
            'physicalinformation' => $init_report_data['physicalinformation'],
            'target_date' => $init_report_data['target_date'],
            'param_target_date' => $init_report_data['param_target_date'],
            'user_id' => $request->user_id,
            'report_type' => 'mealreport',
            'user_information' => $init_report_data['user_information'],
            'mealreport' => $init_report_data['mealreport'],
        ]);
    }
    
    /**
     * init_report
     *
     * @param  mixed $request
     * @return void
     */
    public function init_report($request){
        $input = $request->input();
        
        $input_date = Arr::get($input,'target_date', null);

        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y/m/d');

        if(empty($target_date)){
            $target_date = new DateTime();
            $target_date = $target_date->format('Y/m/d');
        }

        $target_date = Common::get_target_date($input);

        $user_information = current(User::get_users($input));
        $mealreport = MealReportInformation::get_mealreport($target_date, $request->user_id);

        // 身体情報取得
        $physicalinformation = Common::init_physicalinformation($input);
        $tmp_target_date = new DateTime($target_date);
        $param_target_date = $tmp_target_date->format('Ymd');

        $init_report_data = array(
            'physicalinformation' => $physicalinformation,
            'target_date' => $target_date,
            'param_target_date' => $param_target_date,
            'user_id' => $request->user_id,
            'report_type' => 'mealreport',
            'user_information' => $user_information,
            'mealreport' => $mealreport,
        );

        return $init_report_data;
    }
}
