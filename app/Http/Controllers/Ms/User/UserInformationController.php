<?php

namespace App\Http\Controllers\Ms\User;

use App\Http\Controllers\MsController;
use Illuminate\Http\Request;
use App\Models\PhysicalInformation;
use App\Functions\Common;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use DateTime;

class UserInformationController extends MsController
{
    //    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        return view('ms/userinformation/index');
    }

    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request)
    {
        $input = $request->input();
        $user_information = User::get_users($input);
        return view('ms/userinformation/index')->with([
            'user_info' => $user_information
        ]);
    }

    /**
     * add
     *
     * @return void
     */
    public function add()
    {
        return view('ms/userinformation/add');
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
        User::create_user($input);
        return view('ms/userinformation/index');
    }

    /**
     * detail
     *
     * @param  mixed $request
     * @return void
     */
    public function detail(Request $request)
    {
        $input = $request->input();
        $target_date = self::get_target_date($input);
        $user_information = current(User::get_users($input));
        $physicalinformation = self::init_physicalinformation($input);
        $tmp_target_date = new DateTime($target_date);
        $param_target_date = $tmp_target_date->format('Ymd');
        return view('ms/userinformation/detail')->with([
            'physicalinformation' => $physicalinformation,
            'target_date' => $target_date,
            'param_target_date' => $param_target_date,
            'user_id' => $request->user_id,
            'user_information' => $user_information,
        ]);
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

    /**
     * get_target_date
     *
     * @param  mixed $param
     * @return void
     */
    public static function get_target_date($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y-m-d');
        return $target_date;
    }

    /**
     * get_graph_data
     *
     * @param  mixed $request
     * @return void
     */
    public function get_graph_data(Request $request)
    {
        $param = $request->input();
        $start_date = Arr::get($param, 'start_date', null);
        $end_date = Arr::get($param, 'end_date', null);
        $user_id = Arr::get($param, 'user_id', null);
        $type = Arr::get($param, 'type', null);
        $result = PhysicalInformation::get_physicalinformation_for_graph($user_id, $start_date, $end_date, $type);
        $array_result = json_decode(json_encode($result), true);
        header("Content-Type: application/json; charset=UTF-8");
        $array_result = json_encode(
            $array_result,
            JSON_UNESCAPED_SLASHES // スラッシュをエスケープしない
                | JSON_UNESCAPED_UNICODE // 文字列をUnicodeにエスケープしない
        );
        echo $array_result;
        exit;
    }
}
