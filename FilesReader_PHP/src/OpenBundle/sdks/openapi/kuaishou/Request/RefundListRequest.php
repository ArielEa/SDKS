<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

class RefundListRequest implements KuaishouRequestInterface
{
    private $beginTime;

    private $endTime;

    private $type;

    private $pageSize;

    private $currentPage;

    private $sort;

    private $queryType;

    private $negotiateStatus;

    private $pcursor;

    private $status;

    public function apiName(): string
    {
        return 'open.seller.order.refund.pcursor.list';
    }

    public function getApiParas(): array
    {
        return array_filter(get_object_vars($this));
    }

    public function getApiMethod(): string
    {
        return 'GET';
    }

    /**
     * @return mixed
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * @param mixed $beginTime
     * @return RefundListRequest
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
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
     * @return RefundListRequest
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return RefundListRequest
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return RefundListRequest
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     * @return RefundListRequest
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     * @return RefundListRequest
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQueryType()
    {
        return $this->queryType;
    }

    /**
     * @param mixed $queryType
     * @return RefundListRequest
     */
    public function setQueryType($queryType)
    {
        $this->queryType = $queryType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNegotiateStatus()
    {
        return $this->negotiateStatus;
    }

    /**
     * @param mixed $negotiateStatus
     * @return RefundListRequest
     */
    public function setNegotiateStatus($negotiateStatus)
    {
        $this->negotiateStatus = $negotiateStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPcursor()
    {
        return $this->pcursor;
    }

    /**
     * @param mixed $pcursor
     * @return RefundListRequest
     */
    public function setPcursor($pcursor)
    {
        $this->pcursor = $pcursor;
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
     * @return RefundListRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
