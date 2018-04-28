<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 14:10
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 404;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}