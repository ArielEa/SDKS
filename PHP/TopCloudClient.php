<?php

include_once "ResultSet.php";
include_once "TopLogger.php";

class TopCloudClient
{
    public $appkey;
    public $secretKey;
//    public $gatewayUrl = "https://zhao.b2c.omnixdb.com/wms-service/openapi/delivery-confirm";
    public $gatewayUrl = "https://uitestapi.b2c.omnixdb.com/wms-service/openapi/db-instock-confirm";
    public $format = "json";
    public $connectTimeout;
    public $readTimeout;
    protected $signMethod = "md5";
    protected $apiVersion = "1.0";
    public $sdkVersion = "oms-sdk-20220825";
    public $customerid = "cdkj";
    public $body = "";

    public function __construct($appkey = "",$secretKey = "") {
        $this->appkey = $appkey;
        $this->secretKey = $secretKey;
    }

    /**
     * 作用： 生成签名
     * @param array $params
     * @param string $body
     * @return string
     */
    private function generateSignDemo(array $params, string $body)
    {
        ksort($params);
        $stringToBeSigned = $this->secretKey;
        foreach ($params as $k => $v) {
            if(!is_array($v) && "@" != substr($v, 0, 1)) {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $body;
        $stringToBeSigned .= $this->secretKey;
        return strtoupper(md5($stringToBeSigned));
    }

    /**
     * 作用：发送请求
     * @param $url
     * @param null $postFields
     * @return bool|string
     * @throws Exception
     */
    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt ( $ch, CURLOPT_USERAGENT, "top-sdk-php" );

        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_array($postFields) && 0 < count($postFields)) {
            $postMultipart = false;
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
                curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
            }
        }
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch),0);
        } else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new Exception($response,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $response;
    }

    /**
     * 作用：记录文件日志
     * @param $apiName
     * @param $requestUrl
     * @param $errorCode
     * @param $responseTxt
     */
    private function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        $localIp = $_SERVER["SERVER_ADDR"] ?? "CLI";

        $logger = new TopLogger;

        $logger->conf["log_file"] = "./logs/top_biz_err_" . $this->appkey . "_" . date("Y-m-d") . ".log";
        $logger->conf["separator"] = "^_^";
        $logData = array(
            date("Y-m-d H:i:s"),
            $apiName,
            $this->appkey,
            $localIp,
            $requestUrl,
            $errorCode,
            str_replace("\n","",$responseTxt)
        );
        $logger->log($logData);
    }

    /**
     * todo:: 执行请求
     * @param $request
     * @return mixed
     * @throws Exception
     */
    public function execute($request): mixed
    {
        if( $this->gatewayUrl == null ) {
            throw new Exception("client-check-error:Need Set gatewayUrl.");
        }
        $result = new \ResultSet();
        // fixme 组装系统参数
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = 'delivery-confirm';
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams['customerId'] = $this->customerid;

        // fixme:: 获取业务参数
        $apiParams = json_decode($request, true);

        $this->body = $request;

        //系统参数放入GET请求串
        $requestUrl = $this->gatewayUrl."?";
        //签名
        $sysParams['sign'] = $this->generateSignDemo($sysParams, $this->body);

        foreach ($sysParams as $sysParamKey => $sysParamValue) {
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        $requestUrl = substr($requestUrl, 0, -1);
        //发起HTTP请求
        try {
            $resp = $this->curl($requestUrl, $apiParams);
        }
        catch (Exception $e) {
            $this->logCommunicationError(
                $sysParams["method"],$requestUrl,"HTTP_ERROR_" . $e->getCode(), $e->getMessage()
            );
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();
            return $result;
        }
        unset($apiParams);
        unset($fileFields);
        // todo:: 解析TOP返回结果,JSON
        $respWellFormed = false;
        $respObject = json_decode($resp, true);
        if (null !== $respObject && !is_int($resp)) {
            $respWellFormed = true;
        } else {
            return $resp;
        }
        // todo:: 返回的HTTP文本不是标准JSON,记下错误日志
        if (false === $respWellFormed) {
            $this->logCommunicationError($sysParams["method"],$requestUrl,"HTTP_RESPONSE_NOT_WELL_FORMED",$resp);
            $result->code = 0;
            $result->msg = "HTTP_RESPONSE_NOT_WELL_FORMED";
            return $result;
        }
        // todo:: 如果TOP返回了系统级错误码,记录到业务错误日志中
        if (isset($respObject->code)) {
            $this->logCommunicationError($sysParams["method"],$requestUrl,"SYSTEM_ERROR",$resp);
        }
        return $respObject;
    }
}
