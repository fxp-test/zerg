<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 15:57
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\model\Product;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        //  判断订单是成功的
        if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try {
                $order = OrderModel::where('order_no', '=', $orderNo)
                    -> lock(true)
                    -> find();
                if ($order -> status == 1) {
                    $service = new OrderService();
                    $stockStatus = $service -> checkOrderStock($order -> id);
                    //  判断库存是充足的
                    if ($stockStatus['pass']) {
                        $this -> updateOrderStatus($order -> id, true);
                        $this -> reduceStock($stockStatus);
                    } else {
                        $this -> updateOrderStatus($order -> id, false);
                    }
                }
                Db::commit();
                return true;
            } catch(Exception $ex) {
                Db::rollback();
                Log::error($ex);
                return false;
            }
        } else {
            return true;
        }
    }

    private function reduceStock($stockStatus)
    {
        foreach ($stockStatus['pStatusArray'] as $signlePStatus) {
            Product::where('id', '=', $signlePStatus['id'])
                -> setDec('stock', $signlePStatus['count']);
        }
    }

    private function updateOrderStatus($orderID, $success)
    {
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id', '=', $orderID)
            -> update(['status' => $status]);
    }
}