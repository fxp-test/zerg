<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 10:32
 */

namespace app\api\validate;

class TestValidate extends  BaseValidate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
}