<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 11:43
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        /*
            1.获取http传入的参数；2.对这些参数进行校验
         */
        $request = Request::instance();
        $params = $request -> param();

        $result = $this -> check($params);
        if (!$result) {
            $e = new ParameterException([
                'msg' => $this -> error,
            ]);

//            $e -> msg = $this -> error;
            throw $e;
            /*$error = $this -> error;
            throw new Exception($error);//暂时使用tp5的异常提醒*/
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $filed = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value +0) > 0) {
            return true;
        } else {
            return false;
//            return $filed . "必须是正整数";
        }
    }

    public function isNotEmpty($value, $rule = '', $data = '', $filed = '')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }

    public function isMobile($value, $rule = '', $data = '', $filed = '')
    {
        $rule = '/^1[3-8]{1}[0-9]{9}$/';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataByRule($arrays)
    {
        if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)) {
            throw new ParameterException([
                'msg' => '参数中含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray = [];
        foreach ($this -> rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}