<?php

include_once "./TopCloudClient.php";

class batchRequest
{
    private $sign; // 签名
    private $apiKey = 20545653; // app_key
    private $secret = "2e728cadad94400febfb8875ae046c32"; // 密钥
    private $customerId = "CHENGDUKJ"; // 用户customerId
    private $warehouseCode = 'CHENGDUKJ'; // 仓库编码

    private $trackingNo = [
        "2022103011732844103" => "SF6508270002759",
        "2022103011727496364" => "SF6508268750504",
        "2022103011747541202" => "SF1625792203087",
        "2022103011751415701" => "SF1665729406899",
        "2022102911794881302" => "SF1632251737777",
        "2022102911791274901" => "SF6508265863048",
        "2022102911784993031" => "SF1625744287106",
        "2022102911773559901" => "SF1665773095965",
        "2022102911772235354" => "SF1659270456567",
        "2022102911768709801" => "SF1632451437783",
        "2022102911764284101" => "SF1372839516994",
        "2022102911763830702" => "SF6508265880164",
        "2022102911789907702" => "SF1699699556371",
        "2022102911788369003" => "SF1611494998327",
        "2022102911785287701" => "SF1665772057048",
        "2022102911780526002" => "SF1633758937781",
        "2022102911778577577" => "SF1625705279108",
        "2022102911810630201" => "SF1692662054379",
        "2022102911809269202" => "SF1665701984566",
        "2022102911808802601" => "SF1659879614571",
        "2022102811853294902" => "SF1600870853518",
        "2022102811842617802" => "SF1625763457264",
        "2022102811839240201" => "SF1637137437336",
        "2022102811835656364" => "SF1372829930322",
        "2022102911812658801" => "SF1678122003413",
        "2022102811862254344" => "SF6508261368172",
        "2022102811860711303" => "SF6508260777464",
        "2022102811874168702" => "SF1687269739386",
        "2022102811863194701" => "SF1625750062110",
        "2022102811869252301" => "SF6508259779690",
        "2022102711914100306" => "SF1659075059388",
        "2022102711920219401" => "SF1631231527182",
        "2022102711912172801" => "SF1665733728494",
        "2022102711910983301" => "SF1618867266349",
        "2022102711894811701" => "SF1615667208343",
        "2022102711911313601" => "SF6508256702157",
        "2022102711940319002" => "SF1655673689304",
        "2022102711942863702" => "SF1642298640556",
        "2022102711944908602" => "SF1672141227255",
        "2022102711924891012" => "SF1614687921374",
        "2022102711923155101" => "SF1651573849343",
        "2022102611982195762" => "SF1695768457573",
        "2022102711925718701" => "SF1641984469584",
        "2022102711929297001" => "SF1658871793386",
        "2022102711926360405" => "SF1645924430587",
        "2022102711933339502" => "SF1600844682949",
        "2022102711949306103" => "SF1646954151585",
        "2022102611963122002" => "SF1634236097824",
        "2022102611954760604" => "SF1618837496358",
        "2022102611961410401" => "SF1672104269951",
        "2022102611966559702" => "SF1657371497322",
        "2022102611960523002" => "SF1600837423772",
    ];

    public function getFileData($file)
    {
        if (!is_file($file)) {
            exit('没有文件');
        }

        $handle = fopen($file, 'r');
        if (!$handle) {
            exit('读取文件失败');
        }

        $fileDatas = [];
        while (($data = fgetcsv($handle)) !== false) {
            // 下面这行代码可以解决中文字符乱码问题
            // $data[0] = iconv('gbk', 'utf-8', $data[0]);
            // 跳过第一行标题
            if ($data[0] == 'name') {
                continue;
            }
            $fileDatas[] = $data;
        }
        fclose($handle);

        return $fileDatas;
    }

    public function readCsv( $fileName)
    {
        $data = $this->getFileData($fileName);

        unset( $data[0] );

        $newData = [];
        foreach ( $data as $k => $v ) {
            if (isset($newData[$v[0]])) {
                $newData[$v[0]][] = $v;
            } else {
                $newData[$v[0]][] = $v;
            }
        }

        foreach ($newData as $key => $value) {
            $this->single($value);
        }

        die;
    }

    private function single($data)
    {
        $params = [
            "deliveryOrderCode" => $data[0][0],
            "warehouseCode" => "CHENGDUKJ",
            "deliveryOrderId" => $data[0][0],
            "orderType" => "JYCK",
            "status" => "DELIVERED",
            "orderConfirmTime" => date("Y-m-d H:i:s", time()),
            "remark" => "跨境仓确认发货"
        ];
        $package = [];
        $items = [];
        foreach ( $data as $key => $value ) {
            $package[] = [
                "logisticsCode" =>"SF",
                "expressCode" => $this->trackingNo[$value[0]]
            ];
            $items[] = [
                "itemCode" => $value[2],
                "inventoryType" => "ZP",
                "actualQty" => $value[3],
                "batchs" => "",
                "batchCode" => $value[4],
                "productDate" => "",
                "expireDate" => "",
                "produceCode" =>""
            ];
        }
        $info = [
            "deliveryOrder" => $params,
            "packages" => [
                "package" => $package
            ],
            "orderLines" => [
                "orderLine" => $items
            ]
        ];
        $this->send(json_encode($info, JSON_UNESCAPED_UNICODE));
    }

    public function send($data)
    {
        $cloudClient = new TopCloudClient($this->apiKey, $this->secret);

        $result = $cloudClient->execute($data);

        print_r(json_encode($result, JSON_UNESCAPED_UNICODE). PHP_EOL);

        return $result;
    }
}

$input = new batchRequest();
$input->readCsv("chengdu.csv");
