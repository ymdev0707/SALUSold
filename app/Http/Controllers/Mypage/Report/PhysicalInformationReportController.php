<?php

namespace App\Http\Controllers\Mypage\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MealReportInformation;
use App\Models\MealReportInformationDetails;
use App\Functions\Common;
use App\Models\PhysicalInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use DateTime;

use function Psy\debug;

class PhysicalInformationReportController extends Controller
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

        $physicalinformation = current(PhysicalInformation::get_physicalinformation($target_date, $user_id = Auth::id()));
        $disp_target_date = new DateTime($target_date);
        $disp_target_date = $disp_target_date->format('Y-m-d');

        return view('mypage/physicalinformationreport')->with([
            "physicalinformation" => $physicalinformation,
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
        $target_date = $input['target_date'];
        $user_id = Auth::id();

        DB::beginTransaction();
        try {

            PhysicalInformation::regist_physicalinformationreport($user_id, $input);
            DB::commit();
            $target_date = new DateTime($input['target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('mypage/physicalinformationreport/?target_date=' . $target_date);
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
        $user_id = Auth::id();
        try {
            $result = PhysicalInformation::update_physicalinformationreport($user_id, $input);
            DB::commit();
            $target_date = new DateTime($input['target_date']);
            $target_date = $target_date->format('Ymd');
            return redirect('mypage/physicalinformationreport/?target_date=' . $target_date);
        } catch (\Exception $e) {
            Common::debug($e);
            DB::rollback();
        }
    }
}
