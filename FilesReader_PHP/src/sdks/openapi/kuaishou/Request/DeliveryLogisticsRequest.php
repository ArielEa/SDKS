<?php


namespace sdks\openapi\kuaishou\Request;

use sdks\openapi\kuaishou\KuaishouRequestInterface;

class DeliveryLogisticsRequest implements KuaishouRequestInterface
{
    private $orderId;

    private $expressNo;

    private $expressCode;

    private $qualityParam;

    public function apiName(): string
    {
       return 'open.seller.order.goods.deliver';
    }

    public function getApiParas(): array
    {
        return array_filter(get_object_vars($this));
    }

    public function getApiMethod(): string
    {
        return 'POST';
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     * @return DeliveryLogisticsRequest
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpressNo()
    {
        return $this->expressNo;
    }

    /**
     * @param mixed $expressNo
     * @return DeliveryLogisticsRequest
     */
    public function setExpressNo($expressNo)
    {
        $this->expressNo = $expressNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpressCode()
    {
        return $this->expressCode;
    }

    /**
     * @param mixed $expressCode
     * @return DeliveryLogisticsRequest
     */
    public function setExpressCode($expressCode)
    {
        $this->expressCode = $expressCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQualityParam()
    {
        return $this->qualityParam;
    }

    /**
     * @param mixed $qualityParam
     * @return DeliveryLogisticsRequest
     */
    public function setQualityParam($qualityParam)
    {
        $this->qualityParam = $qualityParam;
        return $this;
    }
}
