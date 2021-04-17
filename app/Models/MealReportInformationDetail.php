<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealReportInformationDetail extends Model
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
        'TRAINNER_REPORT',
        'INGETION_CALORIE',
        'MEAL_IMAGE',
        'INGETION_TIME',
        'TARGET_DATE',
        'CREATED_AT',
        'UPDATED_AT',
        'IS_DELETED',
    ];
}
