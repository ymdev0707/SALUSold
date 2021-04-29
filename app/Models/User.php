<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'email',
        'password',
        'birth',
        'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * is_admin
     *
     * @return void
     */
    public static function is_admin($user_id){
        $result = false;
        $param = array(
            'user_id' => $user_id
        );

        $user_info = self::get_users($param);
        if(!empty($user_info)){
            $result = true;
        }
        return $result;
    }

    public static function get_users($param){
        $user_id = Arr::get($param, 'user_id', NULL);
        $name = Arr::get($param, 'name', NULL);
        $sex = Arr::get($param, 'sex', NULL);
        $enrollment_store_id = Arr::get($param, 'enrollment_store_id', NULL);

        $tmp_where ='';
        $where = '';

        if(!empty($user_id)){
            $tmp_where .= 'us.id = ' . $user_id;
        }

        if(!empty($name)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= ' concat(last_name, first_name, last_name_kana, first_name_kana) like ' . "'%" . $name . "%'";
        }

        if(!is_null($sex)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'us.sex = ' . $sex;
        }

        if(!empty($enrollment_store_id)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'esi.enrollment_store_id = ' . $enrollment_store_id;
        }

        if(!empty($tmp_where)){
            $where ='WHERE ';
            $where .= $tmp_where;
        }

        $sql = "
            SELECT
                us.id AS USER_ID,
                concat(last_name, ' ', first_name, '/', last_name_kana, ' ', first_name_kana) AS NAME,
                us.sex AS SEX,
                us.birth AS BIRTH,
                '' AS STAFF,
                sm.STORE_NAME
            FROM
                USERS AS us 
                LEFT JOIN ADMINISTRATOR_INFORMATION AS ai 
                    ON us.id = ai.USER_ID 
                LEFT JOIN ENROLLMENT_STORE_INFORMATION AS esi 
                    ON esi.USER_ID = us.id
                LEFT JOIN STORE_MASTER AS sm 
                    ON sm.STORE_ID = esi.STORE_ID
            {$where}
        ";
        // Common::debug($sql);
        $user_info = DB::select($sql);
        return $user_info;
    }
}
