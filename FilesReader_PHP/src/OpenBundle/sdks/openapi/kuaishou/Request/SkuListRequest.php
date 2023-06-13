<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

class SkuListRequest implements KuaishouRequestInterface
{
    private $kwaiItemId;

    private $pageNumber = 1;

    private $pageSize = 20;

    public function getKwaiItemId()
    {
        return $this->kwaiItemId;
    }

    public function setKwaiItemId($kwaiItemId)
    {
        $this->kwaiItemId = $kwaiItemId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param mixed $pageNumber
     * @return SkuListRequest
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param mixed $pageSize
     * @return SkuListRequest
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.item.list.get';
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
