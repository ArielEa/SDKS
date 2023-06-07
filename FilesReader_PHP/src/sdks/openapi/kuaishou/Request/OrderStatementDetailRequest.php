<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

/**
 * @see https://open.kwaixiaodian.com/docs/api?categoryId=100&apiName=open.funds.center.withdraw.apply&version=1
 * 快手订单结算明细
 */
class OrderStatementDetailRequest implements KuaishouRequestInterface
{
    //结算状态 (WAITING 待结算 INIT 开始结算 APPLIED 结算中 COMPLETED 结算完成)

    public const WAITING_SETTLEMENT = 'WAITING';

    public const INIT_SETTLEMENT = 'INIT';

    public const APPLIED_SETTLEMENT = 'APPLIED';

    public const COMPLETED_SETTLEMENT = 'COMPLETED';

    private $orderId = '';

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return OrderStatementDetailRequest
     */
    public function setOrderId(string $orderId): OrderStatementDetailRequest
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.funds.financial.bill.detail';
    }

    public function getApiParas(): array
    {
        return array_filter(get_object_vars($this));
    }

    public function getApiMethod(): string
    {
        return 'GET';
    }
}
