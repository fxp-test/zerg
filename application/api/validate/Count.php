<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16
 * Time: 14:21
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    public $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}