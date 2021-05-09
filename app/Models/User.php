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
            $tmp_where .= 'user_id = ' . $user_id;
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
            select 
                user_id
                , name
                , namekana
                , concat(name, ' / ', namekana) as concatname
                , sex
                , sex_value
                , birth
                , staff
                , store_name
                , store_name
                , ( 
                    select
                        select_item_name 
                    from
                        select_item_master 
                    where
                        select_item_id = is_admin_value
                ) as is_admin 
            from
                (
                select
                    us.id as user_id,
                    concat(last_name, ' ', first_name) as name,
                    concat(last_name_kana, ' ', first_name_kana) as namekana, 
                    ( 
                        select
                            select_item_name 
                        from
                            select_item_master 
                        where
                            select_item_id = us.sex
                    ) as sex,
                    us.sex as sex_value,
                    us.birth as birth,
                    '' as staff,
                    sm.store_name,
                    case 
                        when ai.administrator_information_id is null 
                            then 200 
                        else 201 
                    end as is_admin_value 
                from
                    users as us 
                    left join administrator_information as ai 
                        on us.id = ai.user_id 
                    left join enrollment_store_information as esi 
                        on esi.user_id = us.id
                    left join store_master as sm 
                        on sm.store_id = esi.store_id
                    ) as tmp
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
