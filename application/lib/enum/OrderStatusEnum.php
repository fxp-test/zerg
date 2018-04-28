<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 10:42
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    //  待支付
    const UNPAID = 1;

    //  已支付
    const PAID = 2;

    //  已发货
    const DELTVERED = 3;

    //  已支付，但库存不足
    const PAID_BUT_OUT_OF = 4;
}