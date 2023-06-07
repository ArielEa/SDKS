<?php

namespace sdks\openapi\kuaishou\Request;

use sdks\openapi\kuaishou\KuaishouRequestInterface;

class DeliveryLogisticsAppendRequest implements KuaishouRequestInterface
{
    private $expressCode;

    private $oid;

    private $expressNo;

    public function apiName(): string
    {
        return 'open.seller.order.goods.logistics.append';
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
    public function getExpressCode()
    {
        return $this->expressCode;
    }

    /**
     * @param mixed $expressCode
     */
    public function setExpressCode($expressCode): void
    {
        $this->expressCode = $expressCode;
    }

    /**
     * @return mixed
     */
    public function getOid()
    {
        return $this->oid;
    }

    /**
     * @param mixed $oid
     */
    public function setOid($oid): void
    {
        $this->oid = $oid;
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
     */
    public function setExpressNo($expressNo): void
    {
        $this->expressNo = $expressNo;
    }
}