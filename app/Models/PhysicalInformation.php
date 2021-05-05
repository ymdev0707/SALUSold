<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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
                    physical_information
                WHERE
                    USER_ID = {$user_id} 
                    AND TARGET_DATE = '{$target_date}'
                    AND IS_DELETED = 0 
                    AND IS_DELETED = 0
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
}
