<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 9:53
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustPositiveInt;


class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id = '')
    {
        (new IDMustPositiveInt()) -> goCheck();
        $pay = new PayService($id);
        return $pay -> pay();
    }

    public function redirectNotify()
    {
        //  1.检查库存量，超卖
        //  2.更新这个订单的status状态(order表)
        //  3.减库存
        //  如果成功处理，返回微信成功处理的信息，否则，需要返回没有成功处理。

        //  特点：post；xml格式；不会携带参数，如：api/:version/pay/notify?data 是会被过滤掉参数的
        $notify = new WxNotify();
        $notify -> Handle();
    }

    /*public function receiveNotify()
    {
        $xmlData = file_get_contents('php://input');
        $result = curl_post_raw('http://fxp.cn/api/v1/pay/re_notify?', $xmlData);
    }*/





}