<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealReportInformationDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MEAL_REPORT_INFORMATION_DETAIL_ID',
        'MEAL_REPORT_INFORMATION_ID',
        'DISPLAY_NUMBER',
        'USER_REPORT',
        'TRAINNER_COMMENT',
        'INGESTION_CALORIE',
        'MEAL_IMAGE',
        'INGESTION_TIME',
        'CREATED_AT',
        'UPDATED_AT',
        'IS_DELETED',
    ];
    
    /**
     * regist_mealreport_details
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @param  mixed $param
     * @return void
     */
    public static function regist_mealreport_details($param){
        $mealreportdetails = new MealReportInformationDetails();
        $result = $mealreportdetails->create([
            'MEAL_REPORT_INFORMATION_ID' => $param['meal_report_information_id'],
            'DISPLAY_NUMBER' => $param['display_number'],
            'USER_REPORT' => $param['user_report'],
            'TRAINNER_COMMENT' => $param['trainner_comment'],
            'INGESTION_CALORIE' => $param['ingestion_calorie'],
            'MEAL_IMAGE' => $param['meal_image'],
            'INGESTION_TIME' => $param['ingestion_time'],
        ]);

        return $result;
    }

    /**
     * delete_mealreport_details
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function delete_mealreport_details($meal_report_information_detail_id){
        $mealreportdetails = new MealReportInformationDetails();
        $result = $mealreportdetails
            ->where([
                'meal_report_information_detail_id' => $meal_report_information_detail_id,
            ])
            ->update([
                'IS_DELETED' => 1,
            ]);
        return $result;
    }
}
