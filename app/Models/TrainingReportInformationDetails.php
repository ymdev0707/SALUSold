<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TrainingReportInformationDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'training_report_information_details_id',
        'training_report_information_id',
        'display_number',
        'training_item_group_id',
        'trainer_report',
        'consumed_calorie',
        'training_time',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
    
    /**
     * regist_trainingreport_details
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @param  mixed $param
     * @return void
     */
    public static function regist_trainingreport_details($param){
        $trainingreportdetails = new TrainingReportInformationDetails();
        $result = $trainingreportdetails->create([
            'training_report_information_id' => $param['training_report_information_id'],
            'display_number' => $param['display_number'],
            'user_report' => $param['user_report'],
            'trainer_report' => $param['trainer_report'],
            'ingestion_calorie' => $param['ingestion_calorie'],
            'training_image' => $param['training_image'],
            'ingestion_time' => $param['ingestion_time'],
        ]);

        return $result;
    }

    /**
     * delete_trainingreport_details
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function update_trainingreport_details($param){
        $trainingreportdetails = new TrainingReportInformationDetails();
        $result = $trainingreportdetails
            ->where([
                'training_report_information_details_id' => Arr::get($param,'training_report_information_details_id'),
            ])
            ->update([
                'user_report' => $param['user_report'],
                'trainer_report' => $param['trainer_report'],
                'ingestion_calorie' => $param['ingestion_calorie'],
                'training_image' => $param['training_image'],
                'ingestion_time' => $param['ingestion_time'],
            ]);
        return $result;
    }
    /**
     * delete_trainingreport_details
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function delete_trainingreport_details($training_report_information_details_id){
        $trainingreportdetails = new TrainingReportInformationDetails();
        $result = $trainingreportdetails
            ->where([
                'training_report_information_details_id' => $training_report_information_details_id,
            ])
            ->update([
                'is_deleted' => 1,
            ]);
        return $result;
    }
}
