<?php


namespace sdks\openapi\kuaishou;


/**
 * Class KuaishouScope
 * @package sdks\openapi\kuaishou
 */
abstract class KuaishouScope
{
    //读取或更新用户的订单信息
    const ORDER_SCOPE = 'merchant_order';

    //读取或更新用户的售后信息
    const REFUND_ORDER_SCOPE = 'merchant_refund';

    //读取或更新用户的物流信息
    const LOGISTICS_SCOPE = 'merchant_logistics';

    //读取或更新用户的订单评价信息
    const COMMENT_SCOPE = 'merchant_comment';

    //读取或更新用户的商品信息
    const PRODUCT_SCOPE = 'merchant_item';

    //读取用户在服务市场订购该应用的信息
    const SERVICEMARKET_SCOPE = 'merchant_servicemarket';

    //读取用户的电商会员信息
    const USER_SCOPE = 'merchant_user';

    //获取你的昵称、头像、地区及性别
    const USER_INFO_SCOPE = 'user_info';
}
