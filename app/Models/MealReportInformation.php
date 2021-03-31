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
        'user_id',
        'meal_report_information',
        'target_date',
        'created_at',
        'updated_at',
        'is_deleted',
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
}
