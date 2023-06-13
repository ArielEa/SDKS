<?php


namespace OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\Request;


use OMS\MiddlewareBundle\Service\OpenApi\Kuaishou\KuaishouRequestInterface;

/**
 * @see https://open.kwaixiaodian.com/docs/api?apiName=open.funds.center.get.daily.bill&version=1
 */
class DayBillRequest implements KuaishouRequestInterface
{
    //1 提交 2 处理中 3 成功 4 失败
    const APPLY_SUCCESS = 1;

    const FILE_PROCESS = 2;

    const FILE_GENERATOR_SUCCESS = 3;

    const FILE_GENERATOR_FAILED = 4;

    private $billDate;

    private $billType;

    private $expireDate;

    /**
     * @return mixed
     */
    public function getBillDate()
    {
        return $this->billDate;
    }

    /**
     * @param mixed $billDate
     * @return DayBillRequest
     */
    public function setBillDate($billDate)
    {
        $this->billDate = $billDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillType()
    {
        return $this->billType;
    }

    /**
     * @param mixed $billType
     * @return DayBillRequest
     */
    public function setBillType($billType)
    {
        $this->billType = $billType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * @param mixed $expireDate
     * @return DayBillRequest
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    public function apiName(): string
    {
        return 'open.funds.center.get.daily.bill';
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
