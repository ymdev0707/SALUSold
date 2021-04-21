<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MealReportInformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USER_ID',
        'MEAL_REPORT_INFORMATION_ID',
        'TARGET_DATE',
        'CREATED_AT',
        'UPDATED_AT',
        'IS_DELETED',
    ];

        
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
                    mri.USER_ID
                    , mri.MEAL_REPORT_INFORMATION_ID
                    , mri.TARGET_DATE
                    , mrid.MEAL_REPORT_INFORMATION_DETAIL_ID
                    , mrid.USER_REPORT
                    , mrid.TRAINNER_COMMENT
                    , mrid.INGESTION_CALORIE
                    , mrid.MEAL_IMAGE
                    , mrid.INGESTION_TIME
                    , mrid.UPDATED_AT 
                FROM
                    MEAL_REPORT_INFORMATION AS mri 
                    LEFT JOIN MEAL_REPORT_INFORMATION_DETAIL AS mrid 
                        ON mri.MEAL_REPORT_INFORMATION_ID = mrid.MEAL_REPORT_INFORMATION_ID 
                WHERE
                    mri.USER_ID = {$user_id} 
                    AND mri.TARGET_DATE = '{$target_date}'
                    AND mri.IS_DELETED = 0 
                    AND mrid.IS_DELETED = 0
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
            'USER_ID' => $user_id,
            'TARGET_DATE' => $target_date,
        ]);
        return $result;
    }
}
