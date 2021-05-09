<?php

namespace App\Functions\Common;

use App\Models\MealReportInformation;
use App\Models\PhysicalInformation;
use Illuminate\Support\Arr;
use DateTime;
use Illuminate\Support\Facades\DB;
use Auth;

class Common
{

    /**
     * init_physicalinformation
     *
     * @param  mixed $param
     * @return void
     */
    public static function init_physicalinformation($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $user_id = Arr::get($param, 'user_id', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y/m/d');

        if (empty($target_date)) {
            $target_date = new DateTime();
            $target_date = $target_date->format('Y/m/d');
        }

        $physicalinformation = current(PhysicalInformation::get_physicalinformation($target_date, $user_id));

        return $physicalinformation;
    }
    
    /**
     * init_mealreportinformation
     *
     * @param  mixed $param
     * @return void
     */
    public static function init_mealreportinformation($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $user_id = Arr::get($param, 'user_id', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y/m/d');

        if (empty($target_date)) {
            $target_date = new DateTime();
            $target_date = $target_date->format('Y/m/d');
        }

        $mealreportinformation = current(MealReportInformation::get_mealreprot($target_date, $user_id));

        return $mealreportinformation;
    }

    /**
     * get_target_date
     *
     * @param  mixed $param
     * @return void
     */
    public static function get_target_date($param)
    {
        $input_date = Arr::get($param, 'target_date', null);
        $target_date = new DateTime($input_date);
        $target_date = $target_date->format('Y-m-d');
        return $target_date;
    }

    /**
     * debug
     *
     * @param  mixed $target
     * @return void
     */
    public static function debug($target)
    {
        echo ('<pre>');
        var_dump($target);
        echo ('</pre>');
        exit;
    }
}
