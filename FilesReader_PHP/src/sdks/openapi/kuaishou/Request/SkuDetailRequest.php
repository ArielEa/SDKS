<?php


namespace sdks\openapi\kuaishou\Request;

use sdks\openapi\kuaishou\KuaishouRequestInterface;


class SkuDetailRequest implements KuaishouRequestInterface
{
    private $kwaiItemId;

    /**
     * @return mixed
     */
    public function getKwaiItemId()
    {
        return $this->kwaiItemId;
    }

    /**
     * @param mixed $kwaiItemId
     * @return SkuDetailRequest
     */
    public function setKwaiItemId($kwaiItemId)
    {
        $this->kwaiItemId = $kwaiItemId;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.item.sku.list.get';
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
