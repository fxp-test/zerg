<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 9:42
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this -> hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            -> find();
        return $user;
    }
}