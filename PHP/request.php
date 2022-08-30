<?php

include_once "./TopCloudClient.php";

class Request
{
    private $sign; // 签名
    private $apiKey = 26314927; // app_key
    private $secret = "7e636468adb10c4840f8d88be14514e0"; // 密钥
    private $customerId = "cdkj"; // 用户customerId
    private $warehouseCode = 'chengdukuajing'; // 仓库编码

    private $body = <<<JSON
{
    "deliveryOrder":{
        "deliveryOrderCode":"220809220008810",
        "warehouseCode":"chengdukuajing",
        "deliveryOrderId":"220809220008810",
        "orderType":"JYCK",
        "status":"DELIVERED",
        "orderConfirmTime":"2022-08-10 11:03:02",
        "operatorCode":"",
        "operatorName":"wms",
        "operateTime":"2022-08-10 11:03:02",
        "remark":""
    },
    "packages":{
        "package":{
            "logisticsCode":"STO",
            "logisticsName":"申通",
            "expressCode":"776401676013754",
            "packageCode":"ZXWL01-1523756",
            "length":"",
            "width":"",
            "height":"",
            "weight":"1.7600",
            "volume":"",
            "invoiceNo":"",
            "packageMaterialList":{
                "packageMaterial":{
                    "type":"XYY35",
                    "quantity":"1"
                }
            },
            "items":{
                "item":{
                    "itemCode":"FFHG006",
                    "itemId":"",
                    "extendProps":{
                        "erpOrderId":""
                    },
                    "quantity":"1"
                }
            }
        }
    },
    "orderLines":{
        "orderLine":{
            "orderLineNo":"1",
            "itemCode":"FFHG006",
            "itemId":"FFHG006",
            "itemName":"Perwoll绮纺 焕新修复洗衣凝乳 彩色衣物专用1.44L -大贸",
            "inventoryType":"ZP",
            "actualQty":"1",
            "batchCode":"",
            "productDate":"2020-11-11",
            "expireDate":"2023-11-11",
            "produceCode":""
        }
    }
}
JSON;

    private $entryOrderBody = <<<JSON
{
    "entryOrder":{
        "entryOrderCode":"E202208243549",
        "entryOrderId":"E202208243549",
        "warehouseCode":"warehouse",
        "ownerCode":"customerId",
        "entryOrderType":"DBRK",
        "outBizCode":"xxxxxx",
        "confirmType":"1",
        "status":"FULFILLED",
        "operateTime":"2021-03-18 19:01:32",
        "remark":"入库"
    },
    "orderLines":{
        "orderLine":{
            "itemCode":"FBAV001",
            "inventoryType":"ZP",
            "actualQty":"1000",
            "batchCode":"",
            "productDate":"2020-11-11 00:00:00",
            "expireDate":"2023-11-11 00:00:00",
            "produceCode":""
        }
    }
}
JSON;



    public function send()
    {
        $cloudClient = new TopCloudClient($this->apiKey, $this->secret);

        $result = $cloudClient->execute($this->entryOrderBody);

        print_r( $result );die;

        return $result;
    }
}

$res = (new Request())->send();

print_r( $res );
die;

