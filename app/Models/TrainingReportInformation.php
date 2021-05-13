<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class TrainingReportInformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'training_report_information_id',
        'user_id',
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
        $result = current(self::get_training_report($target_date, $user_id));
        if(empty($result)){
            return false;
        }else{
            return $result->training_report_information_id;
        }
    }
    
    /**
     * get_training_report
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function get_trainingreport($target_date, $user_id){
        $traininfreport = array();
        $sql = "
            SELECT
                tri.training_report_information_id
                , tri.user_id
                , tri.target_date
                , trid.training_report_information_details_id
                , trid.display_number
                , trid.training_item_group_id
                , trid.trainer_report
                , trid.consumed_calorie
                , trid.training_time 
            FROM
                training_report_information AS tri 
                LEFT JOIN training_report_information_details AS trid 
                    ON tri.training_report_information_id = trid.training_report_information_id 
            WHERE
                tri.user_id = {$user_id} 
                AND tri.target_date = '{$target_date}' 
                AND tri.is_deleted = 0 
                AND trid.is_deleted = 0
        ";
        $traininfreport = DB::select($sql);
        return $traininfreport;
    }    
        
    /**
     * regist_trainingreport
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @param  mixed $param
     * @return void
     */
    public static function regist_trainingreport($target_date, $user_id, $param = null){
        $trainingreport = new TrainingReportInformation();
        $result = $trainingreport->create([
            'user_id' => $user_id,
            'target_date' => $target_date,
        ]);
        return $result;
    }
}
