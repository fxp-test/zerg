<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 16:16
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}