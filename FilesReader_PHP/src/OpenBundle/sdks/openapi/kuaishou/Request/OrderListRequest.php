<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

/**
 * 接口文档
 * @see https://open.kwaixiaodian.com/docs/api?apiName=open.order.cursor.list&categoryId=43&version=1
 */
class OrderListRequest implements KuaishouRequestInterface
{
    //订单状态，0未知 1 全部 2 待付款 3 待发货 4 待收货（已发货）5 已收货 6 交易成功订单 7 已关闭订单
    private $orderViewStatus = 3;

    private $pageSize = 10;

    private $sort;

    //1按创建时间查找 2按更新时间查找 默认创建时间
    private $queryType = 2;

    private $beginTime;

    private $endTime;

    //游标内容 第一次传空串，之后传上一次的cursor返回值，若返回“nomore”则标识到底
    private $cursor;

    /**
     * @return mixed
     */
    public function getOrderViewStatus()
    {
        return $this->orderViewStatus;
    }

    /**
     * @param mixed $orderViewStatus
     * @return OrderListRequest
     */
    public function setOrderViewStatus($orderViewStatus)
    {
        $this->orderViewStatus = $orderViewStatus;
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
     * @return OrderListRequest
     */
    public function setPageSize(int $pageSize): OrderListRequest
    {
        $this->pageSize = $pageSize;
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
     * @return OrderListRequest
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
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
     * @return OrderListRequest
     */
    public function setQueryType(int $queryType): OrderListRequest
    {
        $this->queryType = $queryType;
        return $this;
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
     * @return OrderListRequest
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
     * @return OrderListRequest
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCursor()
    {
        return $this->cursor;
    }

    /**
     * @param mixed $cursor
     * @return OrderListRequest
     */
    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.order.cursor.list';
    }

    public function getApiMethod(): string
    {
        return 'GET';
    }

    public function getApiParas(): array
    {
        return array_filter(get_object_vars($this));
    }
}
