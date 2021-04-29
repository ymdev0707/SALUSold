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
            'user_id' => $user_id,
            'enrollment_type' => 201 // 管理者
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
        $enrollment_type = Arr::get($param, 'enrollment_type', NULL);

        $tmp_where ='';
        $where = '';

        if(!empty($user_id)){
            $tmp_where .= 'USER_ID = ' . $user_id;
        }

        if(!empty($name)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= ' NAME like ' . "'%" . $name . "%'";
        }

        if(!is_null($sex)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'SEX_VALUE = ' . $sex;
        }

        if(!empty($enrollment_store_id)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'ENROLLMENT_STORE_ID= ' . $enrollment_store_id;
        }

        if(!is_null($enrollment_type)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }

            if(is_array($enrollment_type)){
                $enrollment_type = implode(',', $enrollment_type);
            }
            
            $tmp_where .= 'IS_ADMIN_VALUE IN (' . $enrollment_type . ')';
        }
        
        if(!empty($tmp_where)){
            $where ='WHERE ';
            $where .= $tmp_where;
        }
        
        $sql = "
            SELECT 
                USER_ID
                , NAME
                , SEX
                , SEX_VALUE
                , BIRTH
                , STAFF
                , STORE_NAME
                , STORE_NAME
                , ( 
                    SELECT
                        SELECT_ITEM_NAME 
                    FROM
                        SELECT_ITEM_MASTER 
                    WHERE
                        SELECT_ITEM_ID = IS_ADMIN_VALUE
                ) AS IS_ADMIN 
            FROM
                (
                SELECT
                    us.id AS USER_ID,
                    concat(last_name, ' ', first_name, ' / ', last_name_kana, ' ', first_name_kana) AS NAME,
                    ( 
                        SELECT
                            SELECT_ITEM_NAME 
                        FROM
                            SELECT_ITEM_MASTER 
                        WHERE
                            SELECT_ITEM_ID = us.sex
                    ) AS SEX,
                    us.sex AS SEX_VALUE,
                    us.birth AS BIRTH,
                    '' AS STAFF,
                    sm.STORE_NAME,
                    CASE 
                        WHEN ai.ADMINISTRATOR_INFORMATION_ID IS NULL 
                            THEN 200 
                        ELSE 201 
                    END AS IS_ADMIN_VALUE 
                FROM
                    USERS AS us 
                    LEFT JOIN ADMINISTRATOR_INFORMATION AS ai 
                        ON us.id = ai.USER_ID 
                    LEFT JOIN ENROLLMENT_STORE_INFORMATION AS esi 
                        ON esi.USER_ID = us.id
                    LEFT JOIN STORE_MASTER AS sm 
                        ON sm.STORE_ID = esi.STORE_ID
                    ) AS tmp
            {$where}
        ";
        $user_info = DB::select($sql);
        return $user_info;
    }
}
