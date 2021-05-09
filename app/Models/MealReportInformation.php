<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class MealReportInformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'meal_report_information_id',
        'target_date',
        'created_at',
        'updated_at',
        'is_deleted',
    ];

        
    /**
     * judge_regist_process
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function judge_regist_process($target_date, $user_id){
        $result = current(self::get_mealreprot($target_date, $user_id));
        if(empty($result)){
            return false;
        }else{
            return $result->MEAL_REPORT_INFORMATION_ID;
        }
    }

    /**
     * get_mealreprot
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return array $mealrepot
     */
    public static function get_mealreprot($target_date, $user_id){
        $mealrepot = array();
        $sql = "
                SELECT
                    mri.user_id
                    , mri.meal_report_information_id
                    , mri.target_date
                    , mrid.meal_report_information_detail_id
                    , mrid.user_report
                    , mrid.trainner_comment
                    , mrid.ingestion_calorie
                    , mrid.meal_image
                    , mrid.ingestion_time
                    , mrid.updated_at 
                FROM
                    meal_report_information AS mri 
                    LEFT JOIN meal_report_information_details AS mrid 
                        on mri.meal_report_information_id = mrid.meal_report_information_id 
                WHERE
                    mri.user_id = {$user_id} 
                    AND mri.target_date = '{$target_date}'
                    AND mri.is_deleted = 0 
                    AND mrid.is_deleted = 0
        ";
        $mealreport = DB::select($sql);
        return $mealreport;
    }
    
    /**
     * regist_mealreport
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function regist_mealreport($target_date, $user_id, $param = null){
        $mealreport = new MealReportInformation();
        $result = $mealreport->create([
            'user_id' => $user_id,
            'target_date' => $target_date,
        ]);
        return $result;
    }
}
