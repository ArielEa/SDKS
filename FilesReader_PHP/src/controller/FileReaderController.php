<?php

namespace controller;

use sdks\openapi\kuaishou\KuaishouERPTopClient;
use sdks\openapi\kuaishou\Request\DeliveryLogisticsAppendRequest;
use services\readerServices;

class FileReaderController
{
    private $defaultFilesPath = ROOT_PATH."/public/excel_files";

    public function indexAction(string $exts = 'xlsx')
    {
        $filename = $this->defaultFilesPath."/Untitled.xlsx";

//        $PHPExcel = new \PHPExcel();

        $service = new readerServices();

        print_r( $service->reader($filename, $exts) );

        die;
    }

    public function kuaishouAction()
    {

        $filename = $this->defaultFilesPath."/kushou_append.xlsx";

        $service = new readerServices();

        $data = $service->reader($filename);

        unset($data[0], $data[1]);

        $data = array_values($data);

        $courierCodes = [
            "快手顺丰" => 4 ,
            "圆通" => 6
        ];

//        $client = new KuaishouERPTopClient();
//
//        $client->setConfigProvider();
//
//        foreach ($data as $key => $value) {
//
//            $updated = new DeliveryLogisticsAppendRequest();
//
//            $code = $courierCodes[$value['G']];
//
//            $updated->setExpressCode($code);
//            $updated->setExpressNo($value["F"]);
//            $updated->setOid($value["A"]);
//
//            $client->execute($updated);
//        }
//
        return true;
    }
}