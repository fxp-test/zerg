<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/12
 * Time: 9:58
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = 'Parameter error';
    public $errorCode = 10000;
}