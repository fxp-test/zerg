<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 9:29
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    public $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '没有code还想获取Token，做梦昂'
    ];
}