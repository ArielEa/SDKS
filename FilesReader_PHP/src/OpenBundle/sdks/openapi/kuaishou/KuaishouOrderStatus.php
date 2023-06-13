<?php


namespace sdks\openapi\kuaishou;


abstract class KuaishouOrderStatus
{
    // 全部
    const NORMAL = 1;

    // 已付款,待发货
    const WAIT_DELIVERY = 3;

    // 交易成功
    const TRADE_SUCCESS = 6;

    // 已发货,等待买家确认收货
    const ALREADY_DELIVERY = 4;
}
