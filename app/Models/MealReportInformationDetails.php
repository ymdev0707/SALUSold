<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MealReportInformationDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meal_report_information_details_id',
        'meal_report_information_id',
        'display_number',
        'user_report',
        'trainer_report',
        'ingestion_calorie',
        'meal_image',
        'ingestion_time',
        'created_at',
        'updated_at',
        'is_deleted',
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
            'meal_report_information_id' => $param['meal_report_information_id'],
            'display_number' => $param['display_number'],
            'user_report' => $param['user_report'],
            'trainer_report' => $param['trainer_report'],
            'ingestion_calorie' => $param['ingestion_calorie'],
            'meal_image' => $param['meal_image'],
            'ingestion_time' => $param['ingestion_time'],
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
    public static function update_mealreport_details($param){
        $mealreportdetails = new MealReportInformationDetails();
        $result = $mealreportdetails
            ->where([
                'meal_report_information_details_id' => Arr::get($param,'meal_report_information_details_id'),
            ])
            ->update([
                'user_report' => $param['user_report'],
                'trainer_report' => $param['trainer_report'],
                'ingestion_calorie' => $param['ingestion_calorie'],
                'meal_image' => $param['meal_image'],
                'ingestion_time' => $param['ingestion_time'],
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
    public static function delete_mealreport_details($meal_report_information_details_id){
        $mealreportdetails = new MealReportInformationDetails();
        $result = $mealreportdetails
            ->where([
                'meal_report_information_details_id' => $meal_report_information_details_id,
            ])
            ->update([
                'is_deleted' => 1,
            ]);
        return $result;
    }
}
