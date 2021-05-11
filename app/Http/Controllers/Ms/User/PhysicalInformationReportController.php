<?php

namespace App\Http\Controllers\Ms\User;

use App\Functions\Common\Common;
use App\Http\Controllers\MsController;
use Illuminate\Http\Request;
use App\Models\PhysicalInformation;
use Illuminate\Support\Arr;
use DateTime;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;

class PhysicalInformationReportController extends MsController
{
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $input = $request->input();
        $target_date = Common::get_target_date($input);

        $user_information = current(User::get_users($input));

        // 身体情報取得
        $physicalinformation = Common::init_physicalinformation($input);
        $tmp_target_date = new DateTime($target_date);
        $param_target_date = $tmp_target_date->format('Ymd');
        if ($request->ajax()) {
            // Ajaxである
            // $physicalinformation = json_decode(json_encode($physicalinformation), true);
            header("Content-Type: application/json; charset=UTF-8");
            $physicalinformation = json_encode(
                $physicalinformation,
                JSON_UNESCAPED_SLASHES // スラッシュをエスケープしない
                    | JSON_UNESCAPED_UNICODE // 文字列をUnicodeにエスケープしない
            );
            echo $physicalinformation;
            exit;
        } else {
            // Ajaxではない
            // $input = $request->input();
            // $target_date = self::get_target_date($input);

            // $user_information = current(User::get_users($input));

            // // 身体情報取得
            // $physicalinformation = self::init_physicalinformation($input);
            // $tmp_target_date = new DateTime($target_date);
            // $param_target_date = $tmp_target_date->format('Ymd');
            return view('ms/userinformation/detail')->with([
                'physicalinformation' => $physicalinformation,
                'target_date' => $target_date,
                'param_target_date' => $param_target_date,
                'user_id' => $request->user_id,
                'report_type' => 'physicalinformationreport',
                'user_information' => $user_information,
            ]);
        }
    }


    /**
     * init_physicalinformation
     *
     * @param  mixed $param
     * @return void
     */
    public static function init_physicalinformation($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $user_id = Arr::get($param, 'user_id', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y/m/d');

        if (empty($target_date)) {
            $target_date = new DateTime();
            $target_date = $target_date->format('Y/m/d');
        }

        $physicalinformation = current(PhysicalInformation::get_physicalinformation($target_date, $user_id));

        return $physicalinformation;
    }

    public static function get_target_date($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y-m-d');
        return $target_date;
    }

    /**
     * regist
     *
     * @param  mixed $request
     * @return void
     */
    public function regist(Request $request)
    {
        $input = $request->input();
        $target_date = $input['target_date'];
        $user_id = Arr::get($input, 'user_id', null);

        DB::beginTransaction();
        try {

            PhysicalInformation::regist_physicalinformationreport($user_id, $input);
            DB::commit();
            $target_date = new DateTime($input['target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('/ms/userinformation/detail/physicalinformationreport/' . '?user_id=' . $user_id . '&target_date=' . $target_date);
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
    public function update(Request $request)
    {
        DB::beginTransaction();
        $input = $request->input();
        $user_id = Arr::get($input, 'user_id', null);
        try {
            $result = PhysicalInformation::update_physicalinformationreport($user_id, $input);
            DB::commit();
            $target_date = new DateTime($input['target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('/ms/userinformation/detail/physicalinformationreport/' . '?user_id=' . $user_id . '&target_date=' . $target_date);
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }
    }
}
