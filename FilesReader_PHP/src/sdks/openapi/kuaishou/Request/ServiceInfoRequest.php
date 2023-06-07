<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

class ServiceInfoRequest implements KuaishouRequestInterface
{
    private $buyerOpenId;

    /**
     * @return string
     */
    public function getBuyerOpenId()
    {
        return $this->buyerOpenId;
    }

    /**
     * @param string $buyerOpenId
     * @return ServiceInfoRequest
     */
    public function setBuyerOpenId(string $buyerOpenId)
    {
        $this->buyerOpenId = $buyerOpenId;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.service.market.buyer.service.info';
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
