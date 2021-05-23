<?php

namespace App\Models;

use App\Functions\Common;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personal_number',
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
    
    /**
     * get_users
     *
     * @param  mixed $param
     * @return void
     */
    public static function get_users($param){
        $user_id = Arr::get($param, 'user_id', NULL);
        $personal_number = Arr::get($param, 'personal_number', NULL);
        $name = Arr::get($param, 'name', NULL);
        $sex = Arr::get($param, 'sex', NULL);
        $enrollment_store_id = Arr::get($param, 'enrollment_store_id', NULL);
        $enrollment_type = Arr::get($param, 'enrollment_type', NULL);

        $tmp_where ='';
        $where = '';

        if(!empty($user_id)){
            $tmp_where .= 'user_id = ' . $user_id;
        }

        if(!empty($personal_number)){
            $tmp_where .= 'personal_number = ' . $personal_number;
        }

        if(!empty($name)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= ' name like ' . "'%" . $name . "%'";
        }

        if(!is_null($sex)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'sex_value = ' . $sex;
        }

        if(!empty($enrollment_store_id)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }
            $tmp_where .= 'enrollment_store_id= ' . $enrollment_store_id;
        }

        if(!is_null($enrollment_type)){
            if(!empty($tmp_where)){
                $tmp_where .= ' AND ';
            }

            if(is_array($enrollment_type)){
                $enrollment_type = implode(',', $enrollment_type);
            }
            
            $tmp_where .= 'is_admin_value IN (' . $enrollment_type . ')';
        }
        
        if(!empty($tmp_where)){
            $where ='WHERE ';
            $where .= $tmp_where;
        }
        
        $sql = "
        SELECT
            user_id
            , personal_number
            , name
            , namekana
            , concat(name, ' / ', namekana) AS concatname
            , sex
            , sex_value
            , birth
            , staff
            , store_name
            , ( 
                SELECT
                    select_item_name 
                FROM
                    select_item_master 
                WHERE
                    select_item_id = is_admin_value
            ) AS is_admin 
        FROM
            ( 
                SELECT
                    us.id AS user_id
                    , personal_number
                    , concat(last_name, ' ', first_name) AS name
                    , concat(last_name_kana, ' ', first_name_kana) AS namekana
                    , ( 
                        SELECT
                            select_item_name 
                        FROM
                            select_item_master 
                        WHERE
                            select_item_id = us.sex
                    ) AS sex
                    , us.sex AS sex_value
                    , us.birth AS birth
                    , '' AS staff
                    , sm.store_name
                    , CASE 
                        WHEN ai.administrator_information_id IS NULL 
                            THEN 200 
                        ELSE 201 
                        END AS is_admin_value 
                FROM
                    users AS us 
                    LEFT JOIN administrator_information AS ai 
                        ON us.id = ai.user_id 
                    LEFT JOIN enrollment_store_information AS esi 
                        ON esi.user_id = us.id 
                    LEFT JOIN store_master AS sm 
                        ON sm.store_id = esi.store_id
            ) AS tmp

    
            {$where}
        ";
        $user_info = DB::select($sql);
        return $user_info;
    }
    
    /**
     * create_user
     *
     * @param  mixed $data
     * @return void
     */
    public static function create_user($data){
        return User::create([
            'personal_number' => $data['personal_number'],
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name_kana' => $data['last_name_kana'],
            'first_name_kana' => $data['first_name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'sex' => $data['sex'],
            'birth' => $data['birth'],
            'account_suspension_flg' => 0,
            'del_flg' => 0,
            'user_type' => 0,
        ]);
    }
}
