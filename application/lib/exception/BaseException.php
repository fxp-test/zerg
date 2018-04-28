<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 16:08
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //  HTTP 状态码 400,200 etc
    public $code = 400;
    //  错误具体信息
    public $msg = "Parameter error";
    //  自定义的错误码
    public $errorCode = 10000;

    public function __construct($params = [])
    {
        if (!is_array($params))
        {
            return;
        }
        if (array_key_exists('code', $params))
        {
            $this -> code = $params['code'];
        }
        if (array_key_exists('msg', $params))
        {
            $this -> msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params))
        {
            $this -> errorCode = $params['errorCode'];
        }
    }
}