<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 14:55
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 403;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}