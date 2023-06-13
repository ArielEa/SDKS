<?php
include_once "./TopCloudClient.php";

//include_once "/usr/local/var/www/Qimen/CSV/oms.php";

class Request
{
    private $sign; // 签名
    private $apiKey = 26314927; // app_key
    private $secret = "7e636468adb10c4840f8d88be14514e0"; // 密钥
//    private $apiKey = 26314927; // app_key
//    private $secret = "7e636468adb10c4840f8d88be14514e0"; // 密钥
    private $customerId = "SHSYBS"; // 用户customerId
    private $warehouseCode = 'ZB'; // 仓库编码

    private $body = <<<JSON
{"deliveryOrder":{"deliveryOrderCode":"2023052112341169192","warehouseCode":"CHENGDUKJ","deliveryOrderId":"","orderType":"JYCK","status":"DELIVERED","orderConfirmTime":"2023-05-24 05:46:39","remark":"noticeDeliver"},"packages":{"package":{"logisticsCode":"logistics_sftc","expressCode":"SF1633827004169"}},"orderLines":{"orderLine":[{"itemCode":"FCSU460","inventoryType":"ZP","actualQty":"1","batchs":{"batch":[{"batchCode":"20241209","actualQty":"1","inventoryType":"ZP"}]},"batchCode":"20241209"}]}}
JSON;

    private $entryOrderBody = <<<JSON
{"entryOrder":{"entryOrderCode":"E202305184164","entryOrderId":"E202305184164","warehouseCode":"chengdukuajing","ownerCode":"chengdukuajing","entryOrderType":"DBRK","outBizCode":"TS202305181459402593","confirmType":"1","status":"FULFILLED","operateTime":"2023-05-22 15:43:57","remark":"入库"},"orderLines":{"orderLine":[{"itemCode":"SCSN028","inventoryType":"ZP","actualQty":60,"batchCode":"20250401","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU574","inventoryType":"ZP","actualQty":34,"batchCode":"20251226","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU573","inventoryType":"ZP","actualQty":34,"batchCode":"20251222","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU572","inventoryType":"ZP","actualQty":40,"batchCode":"20260104","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU571","inventoryType":"ZP","actualQty":40,"batchCode":"20260109","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU570","inventoryType":"ZP","actualQty":14,"batchCode":"20251227","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU569","inventoryType":"ZP","actualQty":14,"batchCode":"20251227","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU457","inventoryType":"ZP","actualQty":10,"batchCode":"20260123","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU381","inventoryType":"ZP","actualQty":5,"batchCode":"20251220","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU381","inventoryType":"ZP","actualQty":43,"batchCode":"20251023","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU378","inventoryType":"ZP","actualQty":18,"batchCode":"20241008","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU169","inventoryType":"ZP","actualQty":10,"batchCode":"20251214","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSU094","inventoryType":"ZP","actualQty":24,"batchCode":"20251214","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN071","inventoryType":"ZP","actualQty":18,"batchCode":"20251008","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN066","inventoryType":"ZP","actualQty":6,"batchCode":"20250908","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN055","inventoryType":"ZP","actualQty":24,"batchCode":"20250501","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN044","inventoryType":"ZP","actualQty":60,"batchCode":"20240901","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM204","inventoryType":"ZP","actualQty":3,"batchCode":"20260226","productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM074","inventoryType":"ZP","actualQty":10,"batchCode":"20260116","productDate":"","expireDate":"","produceCode":""}]}}
JSON;

    private $newJson = <<<JSON
{
    "entryOrder": {
        "entryOrderCode": "E202212223342",
        "entryOrderId": "E202212223342",
        "warehouseCode": "CHENGDUKJ",
        "ownerCode": "CHENGDU",
        "entryOrderType": "DBRK",
        "outBizCode": "TS202212221440456117",
        "confirmType": "1",
        "status": "FULFILLED",
        "operateTime": "2023-01-01 15:47:06",
        "remark": "入库"
    },
    "orderLines": {
        "orderLine": [
            {
                "itemCode": "FCSU377",
                "inventoryType": "ZP",
                "actualQty": 6,
                "batchCode": 20241111,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU377",
                "inventoryType": "ZP",
                "actualQty": 10,
                "batchCode": 20250420,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU377",
                "inventoryType": "ZP",
                "actualQty": 32,
                "batchCode": 20241124,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU376",
                "inventoryType": "ZP",
                "actualQty": 20,
                "batchCode": 20241123,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU376",
                "inventoryType": "ZP",
                "actualQty": 3,
                "batchCode": 20240506,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU375",
                "inventoryType": "ZP",
                "actualQty": 10,
                "batchCode": 20241123,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU375",
                "inventoryType": "ZP",
                "actualQty": 31,
                "batchCode": 20240505,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU374",
                "inventoryType": "ZP",
                "actualQty": 16,
                "batchCode": 20250420,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU374",
                "inventoryType": "ZP",
                "actualQty": 8,
                "batchCode": 20250209,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU372",
                "inventoryType": "ZP",
                "actualQty": 22,
                "batchCode": 20240427,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU371",
                "inventoryType": "ZP",
                "actualQty": 23,
                "batchCode": 20250118,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU371",
                "inventoryType": "ZP",
                "actualQty": 6,
                "batchCode": 20241220,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU371",
                "inventoryType": "ZP",
                "actualQty": 2,
                "batchCode": 20240427,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU370",
                "inventoryType": "ZP",
                "actualQty": 2,
                "batchCode": 20250627,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU370",
                "inventoryType": "ZP",
                "actualQty": 37,
                "batchCode": 20250214,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU369",
                "inventoryType": "ZP",
                "actualQty": 19,
                "batchCode": 20250420,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU369",
                "inventoryType": "ZP",
                "actualQty": 6,
                "batchCode": 20250214,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU368",
                "inventoryType": "ZP",
                "actualQty": 11,
                "batchCode": 20250209,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU368",
                "inventoryType": "ZP",
                "actualQty": 5,
                "batchCode": 20241123,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU368",
                "inventoryType": "ZP",
                "actualQty": 8,
                "batchCode": 20250518,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU368",
                "inventoryType": "ZP",
                "actualQty": 1,
                "batchCode": 20240426,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCCH119",
                "inventoryType": "ZP",
                "actualQty": 14,
                "batchCode": 20260630,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCCH259",
                "inventoryType": "ZP",
                "actualQty": 11,
                "batchCode": 20260531,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCCH258",
                "inventoryType": "ZP",
                "actualQty": 1,
                "batchCode": 20240731,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCCH256",
                "inventoryType": "ZP",
                "actualQty": 1,
                "batchCode": 20260228,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU343",
                "inventoryType": "ZP",
                "actualQty": 45,
                "batchCode": 20231116,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU343",
                "inventoryType": "ZP",
                "actualQty": 90,
                "batchCode": 20231117,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU335",
                "inventoryType": "ZP",
                "actualQty": 59,
                "batchCode": 20231023,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU337",
                "inventoryType": "ZP",
                "actualQty": 18,
                "batchCode": 20231029,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU337",
                "inventoryType": "ZP",
                "actualQty": 98,
                "batchCode": 20231028,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU336",
                "inventoryType": "ZP",
                "actualQty": 20,
                "batchCode": 20231027,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCSU340",
                "inventoryType": "ZP",
                "actualQty": 41,
                "batchCode": 20231104,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM007",
                "inventoryType": "ZP",
                "actualQty": 12,
                "batchCode": 20241018,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM007",
                "inventoryType": "ZP",
                "actualQty": 2,
                "batchCode": 20230609,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM049",
                "inventoryType": "ZP",
                "actualQty": 9,
                "batchCode": 20250413,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM049",
                "inventoryType": "ZP",
                "actualQty": 1,
                "batchCode": 20241207,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM049",
                "inventoryType": "ZP",
                "actualQty": 8,
                "batchCode": 20230608,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM049",
                "inventoryType": "ZP",
                "actualQty": 10,
                "batchCode": 20240421,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM013",
                "inventoryType": "ZP",
                "actualQty": 18,
                "batchCode": 20241015,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM013",
                "inventoryType": "ZP",
                "actualQty": 25,
                "batchCode": 20240728,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM001",
                "inventoryType": "ZP",
                "actualQty": 17,
                "batchCode": 20240910,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM002",
                "inventoryType": "ZP",
                "actualQty": 13,
                "batchCode": 20240912,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM002",
                "inventoryType": "ZP",
                "actualQty": 14,
                "batchCode": 20241001,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM002",
                "inventoryType": "ZP",
                "actualQty": 2,
                "batchCode": 20240822,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM058",
                "inventoryType": "ZP",
                "actualQty": 4,
                "batchCode": 20231215,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM004",
                "inventoryType": "ZP",
                "actualQty": 18,
                "batchCode": 20240212,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM004",
                "inventoryType": "ZP",
                "actualQty": 18,
                "batchCode": 20240704,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM003",
                "inventoryType": "ZP",
                "actualQty": 26,
                "batchCode": 20240820,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            },
            {
                "itemCode": "FCRM027",
                "inventoryType": "ZP",
                "actualQty": 10,
                "batchCode": 20241115,
                "productDate": "",
                "expireDate": "",
                "produceCode": ""
            }
        ]
    }
}
JSON;

    private $declarationData = <<<JSON
{
    "declaraNo": "2023052312270167902",
    "guid": "7288064f-24ea-41bd-85e1-db2b0814b58d",
    "customsCode": "7900",
    "ebpCode": "3105930341",
    "ebcCode": "510196Z00E",
    "agentCode": "51013699CK",
    "copNo": "51013699CK",
    "preNo": "B20221107070541327",
    "invtNo": "79202022I093777661",
    "returnStatus": "800",
    "returnTime": "2022-11-07 17:17:17",
    "returnInfo": "[Code:2600;Desc:放行]",
    "logisticsCode": "courier_code",
    "trackingNo": "xxxxxxxx",
    "modified": "2023-06-09 12:17:17"
}
JSON;

    private $stockOutData = <<<JSON
{"entryOrder":{"entryOrderCode":"A202306129234","entryOrderId":"A202306129234","warehouseCode":"chengdukuajing","ownerCode":"chengdukuajing","entryOrderType":"DBRK","outBizCode":"TS202306121752312067","confirmType":"1","status":"FULFILLED","operateTime":"2023-06-13 11:00:01","remark":"入库"},"orderLines":{"orderLine":[{"itemCode":"SCSN028","inventoryType":"ZP","actualQty":"38","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCSN016","inventoryType":"ZP","actualQty":"18","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCSN007","inventoryType":"ZP","actualQty":"23","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCSN006","inventoryType":"ZP","actualQty":"36","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH387","inventoryType":"ZP","actualQty":"30","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH370","inventoryType":"ZP","actualQty":"228","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH323","inventoryType":"ZP","actualQty":"60","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH273","inventoryType":"ZP","actualQty":"151","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH225","inventoryType":"ZP","actualQty":"74","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH208","inventoryType":"ZP","actualQty":"53","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"SCCH204","inventoryType":"ZP","actualQty":"47","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN071","inventoryType":"ZP","actualQty":"11","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN066","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN062","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN055","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN046","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCSN041","inventoryType":"ZP","actualQty":"17","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM074","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM070","inventoryType":"ZP","actualQty":"13","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM069","inventoryType":"ZP","actualQty":"12","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM067","inventoryType":"ZP","actualQty":"11","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM064","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM061","inventoryType":"ZP","actualQty":"12","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM059","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM049","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM014","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM013","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM009","inventoryType":"ZP","actualQty":"27","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCRM007","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH305","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH304","inventoryType":"ZP","actualQty":"9","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH303","inventoryType":"ZP","actualQty":"10","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH299","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH298","inventoryType":"ZP","actualQty":"26","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH290","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH289","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH287","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH283","inventoryType":"ZP","actualQty":"9","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH280","inventoryType":"ZP","actualQty":"11","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH276","inventoryType":"ZP","actualQty":"9","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH261","inventoryType":"ZP","actualQty":"32","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH259","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH258","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH247","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH242","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH187","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH120","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH119","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH096","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH093","inventoryType":"ZP","actualQty":"55","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH079","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH075","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH071","inventoryType":"ZP","actualQty":"16","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH065","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH064","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH038","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH035","inventoryType":"ZP","actualQty":"10","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH026","inventoryType":"ZP","actualQty":"90","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH025","inventoryType":"ZP","actualQty":"16","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH023","inventoryType":"ZP","actualQty":"16","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH019","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH018","inventoryType":"ZP","actualQty":"216","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH012","inventoryType":"ZP","actualQty":"26","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH007","inventoryType":"ZP","actualQty":"9","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH004","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH003","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCCH002","inventoryType":"ZP","actualQty":"10","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAB038","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAB015","inventoryType":"ZP","actualQty":"4","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAB011","inventoryType":"ZP","actualQty":"31","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAB010","inventoryType":"ZP","actualQty":"49","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA038","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA037","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA036","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA035","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA033","inventoryType":"ZP","actualQty":"8","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA031","inventoryType":"ZP","actualQty":"6","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA030","inventoryType":"ZP","actualQty":"7","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""},{"itemCode":"FCAA029","inventoryType":"ZP","actualQty":"5","batchCode":20250301,"productDate":"","expireDate":"","produceCode":""}]}}
JSON;



    public function send()
    {
        $cloudClient = new TopCloudClient($this->apiKey, $this->secret);

        $result = $cloudClient->execute($this->stockOutData);

        print_r( $result );

//        $jsonData = getData();

//

//        foreach ($jsonData as $jk => $jv) {
////            $result = $cloudClient->execute($this->body);
//            $result = $cloudClient->execute($jv);
//
//            print_r( $result );
//
////            if (is_array($result) || is_object($result)) {
////                print_r( $result );die;
////            }
////            $res = json_decode($result, true);
////
////            if (is_null($res)) {
////                print_r( $result );
////            } else {
////                print_r( $res );
////            }
//        }


        echo PHP_EOL;
        die;
        return $result;
    }
}

$res = (new Request())->send();

print_r( $res );
die;

