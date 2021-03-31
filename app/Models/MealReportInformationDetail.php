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
        'meal_report_information_detail',
        'meal_report_information',
        'display_number',
        'user_report',
        'trainner_report',
        'ingetion_calorie',
        'meal_image',
        'ingetion_time',
        'target_date',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
