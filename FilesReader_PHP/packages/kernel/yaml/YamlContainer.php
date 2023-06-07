<?php

namespace packages\kernel\yaml;

/**
 * 解析 yaml 文件，并且将数据存储进入一个临时文件中【temp】
 * Class YamlContainer
 * @package packages\kernel\yaml
 */
abstract class YamlContainer
{
    // todo:: 目前是固定位置
    private static $configurationFilePath = ROOT_PATH."/app/config";

    private static $yamlFiles;

    private static $fileSuffix = [".yaml", '.yml'];

    private static $fixYamlParametersColumns = ["parameters", "doctrine", "imports"];

    public function __construct()
    {
    }

    public static function configurationPool()
    {
        self::readerYamlFiles();

        self::saveYamlData();
    }

    private static function readerYamlFiles()
    {
        $dirFiles = scandir(self::$configurationFilePath);

        $yamlFiles = [];

        foreach ($dirFiles as $key => $value) {
            if (in_array($value, ['.', '..'])) continue;

            $fileSuffix = substr($value, strripos($value, '.'));

            if (!in_array($fileSuffix, self::$fileSuffix)) continue;

            $yamlFiles[] = self::$configurationFilePath.'/'.$value;
        }

        self::$yamlFiles = $yamlFiles;
    }

    private static function saveYamlData()
    {
        if (!self::$yamlFiles) return;

        $files = self::$yamlFiles;

        $yamlData = [];

        foreach ($files as $k => $v) {
            $data = \Spyc::YAMLLoad($v);

            if (empty($data)) continue;

            if (!isset($data['parameters'])) {
                // todo:: 参数配置只能存储在parameters中， 这是固定的
                continue;
            }
            $loadData = $data['parameters'];

            foreach ( $loadData as $key => $val ) {
                $yamlData['parameters'][$key] = $val;
            }
            if (isset($data['doctrine'])) {
                $yamlData['doctrine'] = $data['doctrine'];
            }
        }
        if (isset($yamlData['parameters'])) {
            yamlInstances::save('parameters', $yamlData['parameters']);
        }
        if (isset($yamlData['doctrine'])) {
            yamlInstances::save('doctrine', $yamlData['doctrine']);
        }
    }
}