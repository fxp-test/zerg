<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 11:10
 */

namespace app\api\validate;


class IDMustPositiveInt extends BaseValidate
{
    /**
     * 独立验证id是否为正整数
     */
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];
}