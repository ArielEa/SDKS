<?php

namespace services;

/**
 * Class readerServices
 * @package services
 */
class readerServices
{
    public function reader($filename, $exts = "xlsx")
    {

        if ($exts == 'xls') {
//            Vendor("PHPExcel.Reader.Excel5");
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } else if ($exts == 'xlsx') {
//            Vendor("PHPExcel.Reader.Excel2007");
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        }
        //载入文件
        $PHPExcel = $PHPReader->load($filename);

        // 获取工作表sheet, 从0开始计算
        $currentSheet = $PHPExcel->getSheet(0);

        //获取总列数
        $allColumn = $currentSheet->getHighestColumn();

        // 获取总行数
        $allRow = $currentSheet->getHighestRow();

        // 开始的列
        $fistColumn = "A";

        // 行循环
        for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
            // 列循环
            for ($currentColumn = $fistColumn; $currentColumn <= $allColumn; $currentColumn++) {
                // 数据坐标, 例如 A1, A2, B1, B2
                $address = $currentColumn . $currentRow;

                // 获取当前坐标的值
                $columnValues = $currentSheet->getCell($address)->getValue();

                // 判断当前坐标的类型
                if ($currentRow > 1) {
                    if (\PHPExcel_Shared_Date::isDateTime($currentSheet->getCell($address))) {
                        $date = \PHPExcel_Shared_Date::ExcelToPHP($columnValues);

                        $columnValues = date("Y-m-d H:i:s", $date);
                    }
                    if (\PHPExcel_Cell_DataType::dataTypeForValue($columnValues) == 'f') {
                        /**
                         * PHPExcel_Cell_DataType::dataTypeForValue($val);
                         * 因为公式是字符串。作为公式与单元格相关，而不是数据。
                         * 单元格对象的 getDataType() 方法将为公式返回一个 'f'。
                         *
                         * todo::
                         *      getCalculatedValue 获取对象
                         *      getFormattedValue  获取计算后的值
                         */
                        $columnValues = $currentSheet->getCell($address)->getFormattedValue();
                    }
                }
                //读取到的数据，保存到数组$arr中
                $data[$currentRow][$currentColumn] = $columnValues;
            }
        }
        return array_values($data);
    }
}