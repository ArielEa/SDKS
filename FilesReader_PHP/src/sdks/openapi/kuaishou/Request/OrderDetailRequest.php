<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

/**
 * @see https://open.kwaixiaodian.com/docs/api?apiName=open.order.detail&categoryId=43&version=1
 */
class OrderDetailRequest implements KuaishouRequestInterface
{
    private $oid;

    /**
     * @return mixed
     */
    public function getOid()
    {
        return $this->oid;
    }

    /**
     * @param mixed $oid
     * @return OrderDetailRequest
     */
    public function setOid($oid)
    {
        $this->oid = $oid;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.order.detail';
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
