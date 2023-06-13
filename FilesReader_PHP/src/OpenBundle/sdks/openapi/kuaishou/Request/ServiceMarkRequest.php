<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

class ServiceMarkRequest implements KuaishouRequestInterface
{
    private $startTime;

    private $endTime;

    private $queryType = 1;

    private $pageSize = 100;

    private $pageNum = 1;

    private $status;

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     * @return ServiceMarkRequest
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     * @return ServiceMarkRequest
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getQueryType(): int
    {
        return $this->queryType;
    }

    /**
     * @param int $queryType
     * @return ServiceMarkRequest
     */
    public function setQueryType(int $queryType): ServiceMarkRequest
    {
        $this->queryType = $queryType;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return ServiceMarkRequest
     */
    public function setPageSize(int $pageSize): ServiceMarkRequest
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageNum(): int
    {
        return $this->pageNum;
    }

    /**
     * @param int $pageNum
     * @return ServiceMarkRequest
     */
    public function setPageNum(int $pageNum): ServiceMarkRequest
    {
        $this->pageNum = $pageNum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ServiceMarkRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.service.market.order.list';
    }

    public function getApiParas(): array
    {
        return  array_filter(get_object_vars($this));
    }

    public function getApiMethod(): string
    {
        return 'GET';
    }
}
