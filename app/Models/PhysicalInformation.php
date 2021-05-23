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
        'user_id',
        'height',
        'weight',
        'body_fat_percentage',
        'muscle_mass',
        'target_date',
        'is_session',
        'created_at',
        'updated_at',
        'is_deleted',
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
                    physical_information
                WHERE
                    user_id = {$user_id} 
                    and target_date = '{$target_date}'
                    and is_deleted = 0 
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
        $is_session = Arr::get($param, 'is_session');
        $result = $physicalinformation->create([
            'user_id' => $user_id,
            'height' => Arr::get($param, 'height'),
            'weight' => Arr::get($param, 'weight'),
            'body_fat_percentage' => Arr::get($param, 'body_fat_percentage'),
            'muscle_mass' => Arr::get($param, 'muscle_mass'),
            'target_date' => Arr::get($param, 'target_date'),
            'is_session' => $is_session === 'true' ? 1 : 0,
        ]);
        return $result;
    }
        
    public static function update_physicalinformationreport($user_id, $param){
        $physicalinformation = new PhysicalInformation();
        $is_session = Arr::get($param, 'is_session');
        $result = $physicalinformation
            ->where([
                'user_id' => $user_id,
                'target_date' => Arr::get($param, 'target_date'),
            ])
            ->update([
                'height' => Arr::get($param, 'height'),
                'weight' => Arr::get($param, 'weight'),
                'body_fat_percentage' => Arr::get($param, 'body_fat_percentage'),
                'muscle_mass' => Arr::get($param, 'muscle_mass'),
                'target_date' => Arr::get($param, 'target_date'),
                'is_session' => $is_session === 'true' ? 1 : 0,
            ]);
        return $result;
    }
    
    /**
     * get_physicalinformation_for_graph_all
     *
     * @param  mixed $user_id
     * @param  mixed $start_date
     * @param  mixed $end_date
     * @return void
     */
    public static function get_physicalinformation_for_graph_all($user_id, $start_date, $end_date){
        $calc_start_date = new DateTime($start_date);
        $calc_end_date = new DateTime($end_date);
        $calc_date = $calc_end_date->diff($calc_start_date);

        // 描画する日数
        $date_diff = $calc_date->format('%a') + 1;

        $sql = "
            SELECT
                target_date_key AS target_date_key
                , physical_information_id AS physical_information_id
                , user_id AS user_id
                , ifnull(height, 0) as height
                , ifnull(weight, 0) as weight
                , ifnull(body_fat_percentage, 0) as body_fat_percentage
                , ifnull(muscle_mass, 0) as muscle_mass
                , target_date
                , is_session
                , date_format(target_date_key,'%c/%e') as disp_target_date
                , created_at
                , updated_at
                , is_deleted 
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
                        physical_information 
                    WHERE
                        target_date BETWEEN '{$start_date}' AND '{$end_date}'  
                        AND user_id = {$user_id} 
                        AND is_deleted = 0
                ) AS pi 
                    ON pi.target_date = calendar.target_date_key
            ORDER BY
            target_date_key ASC
        ";
        $physicalinformation = DB::select($sql);
        return $physicalinformation;
    }
    
    /**
     * get_physicalinformation_for_graph_session
     *
     * @param  mixed $user_id
     * @param  mixed $start_date
     * @param  mixed $end_date
     * @return void
     */
    public static function get_physicalinformation_for_graph_session($user_id, $start_date, $end_date){
        $sql = "
            SELECT
                *,
                date_format(target_date,'%c/%e') as disp_target_date 
            FROM
                physical_information 
            WHERE
                target_date BETWEEN '{$start_date}' AND '{$end_date}'  
                AND user_id = {$user_id} 
                AND is_session = 1
                AND is_deleted = 0
        ";
        $physicalinformation = DB::select($sql);
        return $physicalinformation;
    }
}
