<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 16:16
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定的商品不存在，请检查参数';
    public $errorCode = 20000;
}