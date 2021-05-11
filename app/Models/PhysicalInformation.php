<?php

namespace App\Models;

use App\Functions\Common;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

class PhysicalInformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USER_ID',
        'HEIGHT',
        'WEIGHT',
        'BODY_FAT_PERCENTAGE',
        'MUSCLE_MASS',
        'TARGET_DATE',
        'CREATED_AT',
        'UPDATED_AT',
        'IS_DELETED',
    ];

    /**
     * get_physicalinformation
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function get_physicalinformation($target_date, $user_id){
        $physicalinformation = array();
        $sql = "
                SELECT
                    *
                FROM
                    PHYSICAL_INFORMATION
                WHERE
                    USER_ID = {$user_id} 
                    and TARGET_DATE = '{$target_date}'
                    and IS_DELETED = 0 
        ";
        
        $physicalinformation = DB::select($sql);
        return $physicalinformation;
    }
    
    /**
     * regist_physicalinformationreport
     *
     * @param  mixed $target_date
     * @param  mixed $user_id
     * @return void
     */
    public static function regist_physicalinformationreport($user_id, $param){
        $physicalinformation = new PhysicalInformation();
        $result = $physicalinformation->create([
            'USER_ID' => $user_id,
            'HEIGHT' => Arr::get($param, 'height'),
            'WEIGHT' => Arr::get($param, 'weight'),
            'BODY_FAT_PERCENTAGE' => Arr::get($param, 'body_fat_percentage'),
            'MUSCLE_MASS' => Arr::get($param, 'muscle_mass'),
            'TARGET_DATE' => Arr::get($param, 'target_date'),
        ]);
        return $result;
    }
        
    public static function update_physicalinformationreport($user_id, $param){
        $physicalinformation = new PhysicalInformation();
        $result = $physicalinformation
            ->where([
                'USER_ID' => $user_id,
                'TARGET_DATE' => Arr::get($param, 'target_date'),
            ])
            ->update([
                'HEIGHT' => Arr::get($param, 'height'),
                'WEIGHT' => Arr::get($param, 'weight'),
                'BODY_FAT_PERCENTAGE' => Arr::get($param, 'body_fat_percentage'),
                'MUSCLE_MASS' => Arr::get($param, 'muscle_mass'),
                'TARGET_DATE' => Arr::get($param, 'target_date'),
            ]);
        return $result;
    }
    
    /**
     * get_physicalinformation_for_graph
     *
     * @param  mixed $user_id
     * @param  mixed $start_date
     * @param  mixed $end_date
     * @return void
     */
    public static function get_physicalinformation_for_graph($user_id, $start_date, $end_date){
        $calc_start_date = new DateTime($start_date);
        $calc_end_date = new DateTime($end_date);
        $calc_date = $calc_end_date->diff($calc_start_date);

        // 描画する日数
        $date_diff = $calc_date->format('%a') + 1;

        $sql = "
            SELECT
                TARGET_DATE_KEY
                , PHYSICAL_INFORRMATION_ID
                , USER_ID
                , ifnull(HEIGHT, 0) as HEIGHT
                , ifnull(WEIGHT, 0) as WEIGHT
                , ifnull(BODY_FAT_PERCENTAGE, 0) as BODY_FAT_PERCENTAGE
                , ifnull(MUSCLE_MASS, 0) as MUSCLE_MASS
                , TARGET_DATE
                , date_format(TARGET_DATE_KEY,'%c/%e') as DISP_TARGET_DATE
                , CREATED_AT
                , UPDATED_AT
                , IS_DELETED 
            FROM
                ( 
                    SELECT
                        DATE_FORMAT( 
                            DATE_ADD(DATE_ADD({$start_date}, INTERVAL - 1 DAY), INTERVAL td.generate_series DAY)
                            , '%Y-%m-%d'
                        ) AS target_date_key 
                    FROM
                        ( 
                            SELECT
                                0 generate_series 
                            FROM
                                DUAL 
                            WHERE
                                (@num := 1 - 1) * 0 
                            UNION ALL 
                            SELECT
                                @num := @num + 1 
                            FROM
                                information_schema.COLUMNS 
                            LIMIT
                                {$date_diff}
                        ) AS td
                ) AS calendar 
                LEFT JOIN ( 
                    SELECT
                        * 
                    FROM
                        PHYSICAL_INFORMATION 
                    WHERE
                        TARGET_DATE BETWEEN '{$start_date}' AND '{$end_date}'  
                        AND USER_ID = {$user_id} 
                        AND IS_DELETED = 0
                ) AS pi 
                    ON pi.TARGET_DATE = calendar.TARGET_DATE_KEY
            ORDER BY
            TARGET_DATE_KEY ASC
        ";
        $physicalinformation = DB::select($sql);
        return $physicalinformation;
    }
}
