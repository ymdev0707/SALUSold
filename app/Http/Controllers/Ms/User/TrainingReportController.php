<?php

namespace App\Http\Controllers\Ms\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingReportInformation;
use App\Models\TrainingReportInformationDetails;
use App\Functions\Common\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use DateTime;
use App\Models\User;
use Symfony\Component\ErrorHandler\Debug;

class TrainingReportController extends Controller
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
            'report_type' => 'trainingreport',
            'user_information' => $init_report_data['user_information'],
            'trainingreport' => $init_report_data['trainingreport'],
        ]);
    }
        
    /**
     * regist
     *
     * @param  mixed $request
     * @return void
     */
    public function regist(Request $request){
        // トレーニング報告を登録する
        $input = $request->input();
        $target_date = $input['form_target_date'];
        $user_id = $request->user_id;
        $training_report_information_id = null;

        DB::beginTransaction();
        try {
            // トレーニング報告情報を登録
            $judge_result = TrainingReportInformation::judge_regist_process($target_date, $user_id);
            if(!$judge_result){
                $training_report_information = TrainingReportInformation::regist_trainingreport($target_date, $user_id);
                $training_report_information_id = $training_report_information->id;
            }else{
                $training_report_information_id = $judge_result;
            }
            
            // トレーニング報告情報詳細を登録
            $param = array(
                'training_report_information_id' => $training_report_information_id,
                'display_number' => 0,
                'user_report' => Arr::get($input,'user_report'),
                'trainer_report' => Arr::get($input,'trainer_report'),
                'ingestion_calorie' => Arr::get($input,'ingestion_calorie'),
                'training_image' => Arr::get($input,'training_image'),
                'ingestion_time' => Arr::get($input,'ingestion_time'),
            );
            $training_report_information = TrainingReportInformationDetails::regist_trainingreport_details($param);
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
            'report_type' => 'trainingreport',
            'user_information' => $init_report_data['user_information'],
            'trainingreport' => $init_report_data['trainingreport'],
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
            $result = TrainingReportInformationDetails::update_trainingreport_details($input);
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
            'report_type' => 'trainingreport',
            'user_information' => $init_report_data['user_information'],
            'trainingreport' => $init_report_data['trainingreport'],
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
            $result = TrainingReportInformationDetails::delete_trainingreport_details(Arr::get($input,'training_report_information_details_id'));
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
            'report_type' => 'trainingreport',
            'user_information' => $init_report_data['user_information'],
            'trainingreport' => $init_report_data['trainingreport'],
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
        $trainingreport = TrainingReportInformation::get_trainingreport($target_date, $request->user_id);

        // 身体情報取得
        $physicalinformation = Common::init_physicalinformation($input);
        $tmp_target_date = new DateTime($target_date);
        $param_target_date = $tmp_target_date->format('Ymd');

        $init_report_data = array(
            'physicalinformation' => $physicalinformation,
            'target_date' => $target_date,
            'param_target_date' => $param_target_date,
            'user_id' => $request->user_id,
            'report_type' => 'trainingreport',
            'user_information' => $user_information,
            'trainingreport' => $trainingreport,
        );

        return $init_report_data;
    }
}
